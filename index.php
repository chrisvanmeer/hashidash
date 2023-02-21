<?php

  $inv            = json_decode($_ENV['INVENTORY']);
  $consul_address = $_ENV['CONSUL_HTTP_ADDR'];
  $consul_token   = $_ENV['CONSUL_HTTP_TOKEN'];

  $pillars = [];

  foreach ($inv->{"consul_servers"}->{'hosts'} as $h) {
    $pillars["Consul"]["Servers"][] = $h;
    $pillars["Consul"]["Checks"] = [];
  }
  foreach ($inv->{"vault_servers"}->{'hosts'} as $h) {
    $pillars["Vault"]["Servers"][] = $h;
    $pillars["Vault"]["Checks"] = ["consul_client"];
  }
  foreach ($inv->{"nomad_servers"}->{'hosts'} as $h) {
    $pillars["Nomad"]["Servers"][] = $h;
    $pillars["Nomad"]["Checks"] = ["consul_client"];
  }
  foreach ($inv->{"docker_clients"}->{'hosts'} as $h) {
    $pillars["Docker"]["Servers"][] = $h;
    $pillars["Docker"]["Checks"] = ["consul_client", "nomad_client"];
  }

  function consul_curl ($path, $element) {
    global $consul_address, $consul_token, $pillars, $checks;

    $url = $consul_address.$path;
    $ch = curl_init($url);
    $options = array(
      CURLOPT_RETURNTRANSFER => true,         // return web page
      CURLOPT_HEADER         => false,        // don't return headers
      CURLOPT_FOLLOWLOCATION => false,         // follow redirects
      CURLOPT_AUTOREFERER    => true,         // set referer on redirect
      CURLOPT_CONNECTTIMEOUT => 20,          // timeout on connect
      CURLOPT_TIMEOUT        => 20,          // timeout on response
      CURLOPT_SSL_VERIFYHOST => 0,            // don't verify ssl
      CURLOPT_SSL_VERIFYPEER => false,        //
      CURLOPT_VERBOSE        => 1,
      CURLOPT_HTTPHEADER     => array(
          "X-Consul-Token: $consul_token",
          "Content-Type: application/json"
      )

    );

    curl_setopt_array($ch,$options);
    $data = curl_exec($ch);
    $curl_errno = curl_errno($ch);
    $curl_error = curl_error($ch);
    //echo $curl_errno;
    //echo $curl_error;
    curl_close($ch);
    $data = json_decode($data);
    $output = [];
    foreach ($data as $d) {
      $output[] = $d->$element;
    };
    return $output;
  }

  $consul_servers = array_unique(consul_curl("/v1/catalog/service/consul", "Node"));
  $vault_servers  = array_unique(consul_curl("/v1/catalog/service/vault", "Node"));
  $nomad_servers  = array_unique(consul_curl("/v1/catalog/service/nomad", "Node"));
  $consul_clients = array_unique(consul_curl("/v1/agent/members", "Name"));
  $nomad_clients  = array_unique(consul_curl("/v1/catalog/service/nomad-client", "Node"));

  $bla = [
    $consul_servers,
    $vault_servers,
    $nomad_servers,
    $consul_clients,
    $nomad_clients
  ];

?>

<!doctype html>
<html lang="en" class="h-100">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>HashiDash</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
  <link rel="stylesheet" href="css/common.css">
  <link rel="stylesheet" href="css/style.css">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://kit.fontawesome.com/3ecf3fa4f9.js" crossorigin="anonymous"></script>
</head>

<body class="d-flex h-100">

  <div class="container-fluid g-0">
    <header>
      <div class="container-fluid g-0">
        <div class="col text-bg-dark fw-bold border-bottom display-6 p-4 shadow mb-4">
          <i class="fak fa-hashicorp text-white me-2"></i>HashiDash
        </div>
      </div>
    </header>
    <main class="d-flex h-75 align-items-center">
      <div class="container-fluid pt-2 h-100">
        <div class="row d-flex flex-row h-100 text-center">

          <?php foreach ($pillars as $pillar => $pillar_data) { ?>
          <div class="col border-end d-flex flex-column h-100">
            <div class="bg-light fw-medium fs-4 py-2 shadow-sm mb-5 border"><i
                class="fak fa-<?=strtolower($pillar)?> color-<?=strtolower($pillar)?> me-2"></i><?=$pillar?>
            </div>
            <div class="d-flex align-items-start flex-column h-100 align-items-center">
              <?php foreach ($pillar_data["Servers"] as $server) { ?>
              <?php
                  $totalchecks = count($pillar_data["Checks"]) + 1;
                  $currentchecks = 0;

                  if (in_array($server, $consul_servers)) {
                    $c = "consul"; $currentchecks++; $currentchecks++;
                  } elseif (in_array($server, $vault_servers)) {
                    $c = "vault"; $currentchecks++;
                  } elseif (in_array($server, $nomad_servers)) {
                    $c = "nomad"; $currentchecks++;
                  } elseif (in_array($server, $nomad_clients)) {
                    $c = "docker"; $currentchecks++;
                  } else {
                    $c = "gray";
                  }

                  if (in_array($server, $consul_clients)) { $cc = "consul"; $currentchecks++; } else { $cc = "gray"; }
                  if (in_array($server, $nomad_clients)) { $nc = "nomad"; $currentchecks++; } else { $nc = "gray"; }
                  if ($currentchecks == $totalchecks) { $border = " border-color-success"; } else { $border = " border-color-danger"; }
                  if ($currentchecks == 0) { $border = ""; }
                ?>
              <div class="d-flex col flex-column text-center">
                <div class="border rounded p-4 d-flex flex-column server<?=$border?>">
                  <span class="fa-stack mb-4">
                    <i class="fak fa-<?=strtolower($pillar)?> fa-stack-1x color-<?=$c?>"
                      data-fa-transform="left-13"></i>
                    <?php if (in_array("consul_client", $pillar_data["Checks"])) { ?>
                    <i class="fak fa-consul fa-stack-1x color-<?=$cc?>" data-fa-transform="up-22 left-40"></i>
                    <?php } ?>
                    <?php if (in_array("nomad_client", $pillar_data["Checks"])) { ?>
                    <i class="fak fa-nomad fa-stack-1x color-<?=$nc?>" data-fa-transform="up-22 right-40"></i>
                    <?php } ?>
                    <i class="fat fa-server fa-4x"></i>
                  </span>
                  <span class="mt-1"><?=$server?></span>
                </div>
              </div>
              <?php } ?>
            </div>
          </div>

          <?php } ?>

        </div>
      </div>
    </main>
  </div>
</body>

</html>

<!-- 
              <div class="d-flex col flex-column text-center">
                <div class="border rounded p-4 d-flex flex-column server">
                  <span class="fa-stack mb-4">
                    <i class="fak fa-docker fa-stack-1x color-docker" data-fa-transform="left-12"></i>
                    <i class="fak fa-consul fa-stack-1x color-gray" data-fa-transform="up-22 left-40"></i>
                    <i class="fak fa-nomad fa-stack-1x color-gray" data-fa-transform="up-22 right-40"></i>
                    <i class="fat fa-server fa-4x"></i>
                  </span>
                  <span class="mt-1">docker3</span>
                </div>
              </div> -->