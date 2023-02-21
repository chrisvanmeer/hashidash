<?php

  $inv = $_ENV['INVENTORY'];

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

  <pre>
  <?php print_r($inv['consul_clients']); ?>
  </pre>

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
          <div class="col border-end d-flex flex-column h-100">
            <div class="bg-light fw-medium fs-4 py-2 shadow-sm mb-5 border"><i
                class="fak fa-consul color-consul me-2"></i>Consul
            </div>
            <div class="d-flex align-items-start flex-column h-100 align-items-center">
              <div class="d-flex col flex-column text-center">
                <div class="border rounded p-4 d-flex flex-column server">
                  <span class="fa-stack mb-4">
                    <i class="fak fa-consul fa-stack-1x color-gray" data-fa-transform="left-13"></i>
                    <i class="fat fa-server fa-4x"></i>
                  </span>
                  <span class="mt-1">consul1</span>
                </div>
              </div>
              <div class="d-flex col flex-column text-center">
                <div class="border rounded p-4 d-flex flex-column server">
                  <span class="fa-stack mb-4">
                    <i class="fak fa-consul fa-stack-1x color-gray" data-fa-transform="left-13"></i>
                    <i class="fat fa-server fa-4x"></i>
                  </span>
                  <span class="mt-1">consul2</span>
                </div>
              </div>
              <div class="d-flex col flex-column text-center">
                <div class="border rounded p-4 d-flex flex-column server">
                  <span class="fa-stack mb-4">
                    <i class="fak fa-consul fa-stack-1x color-gray" data-fa-transform="left-13"></i>
                    <i class="fat fa-server fa-4x"></i>
                  </span>
                  <span class="mt-1">consul3</span>
                </div>
              </div>
            </div>
          </div>
          <div class="col border-end d-flex flex-column h-100">
            <div class="bg-light fw-medium fs-4 py-2 shadow-sm mb-5 border"><i
                class="fak fa-vault color-vault me-2"></i>Vault</div>
            <div class="d-flex align-items-start flex-column h-100 align-items-center">
              <div class="d-flex col flex-column text-center">
                <div class="border rounded p-4 d-flex flex-column server">
                  <span class="fa-stack mb-4">
                    <i class="fak fa-vault fa-stack-1x color-gray" data-fa-transform="left-13"></i>
                    <i class="fak fa-consul fa-stack-1x color-gray" data-fa-transform="up-22 left-40"></i>
                    <i class="fat fa-server fa-4x"></i>
                  </span>
                  <span class="mt-1">vault1</span>
                </div>
              </div>
              <div class="d-flex col flex-column text-center">
                <div class="border rounded p-4 d-flex flex-column server">
                  <span class="fa-stack mb-4">
                    <i class="fak fa-vault fa-stack-1x color-gray" data-fa-transform="left-12"></i>
                    <i class="fak fa-consul fa-stack-1x color-gray" data-fa-transform="up-22 left-40"></i>
                    <i class="fat fa-server fa-4x"></i>
                  </span>
                  <span class="mt-1">vault2</span>
                </div>
              </div>
              <div class="d-flex col flex-column text-center">
                <div class="border rounded p-4 d-flex flex-column server">
                  <span class="fa-stack mb-4">
                    <i class="fak fa-vault fa-stack-1x color-gray" data-fa-transform="left-12"></i>
                    <i class="fak fa-consul fa-stack-1x color-gray" data-fa-transform="up-22 left-40"></i>
                    <i class="fat fa-server fa-4x"></i>
                  </span>
                  <span class="mt-1">vault3</span>
                </div>
              </div>
            </div>
          </div>
          <div class="col border-end d-flex flex-column h-100">
            <div class="bg-light fw-medium fs-4 py-2 shadow-sm mb-5 border"><i
                class="fak fa-nomad color-nomad me-2"></i>Nomad</div>
            <div class="d-flex align-items-start flex-column h-100 align-items-center">
              <div class="d-flex col flex-column text-center">
                <div class="border rounded p-4 d-flex flex-column server">
                  <span class="fa-stack mb-4">
                    <i class="fak fa-nomad fa-stack-1x color-gray" data-fa-transform="left-12"></i>
                    <i class="fak fa-consul fa-stack-1x color-gray" data-fa-transform="up-22 left-40"></i>
                    <i class="fat fa-server fa-4x"></i>
                  </span>
                  <span class="mt-1">nomad1</span>
                </div>
              </div>
              <div class="d-flex col flex-column text-center">
                <div class="border rounded p-4 d-flex flex-column server">
                  <span class="fa-stack mb-4">
                    <i class="fak fa-nomad fa-stack-1x color-gray" data-fa-transform="left-12"></i>
                    <i class="fak fa-consul fa-stack-1x color-gray" data-fa-transform="up-22 left-40"></i>
                    <i class="fat fa-server fa-4x"></i>
                  </span>
                  <span class="mt-1">nomad2</span>
                </div>
              </div>
              <div class="d-flex col flex-column text-center">
                <div class="border rounded p-4 d-flex flex-column server">
                  <span class="fa-stack mb-4">
                    <i class="fak fa-nomad fa-stack-1x color-gray" data-fa-transform="left-12"></i>
                    <i class="fak fa-consul fa-stack-1x color-gray" data-fa-transform="up-22 left-40"></i>
                    <i class="fat fa-server fa-4x"></i>
                  </span>
                  <span class="mt-1">nomad3</span>
                </div>
              </div>
            </div>
          </div>
          <div class="col d-flex flex-column h-100">
            <div class="bg-light fw-medium fs-4 py-2 shadow-sm mb-5 border"><i
                class="fak fa-docker color-docker me-2"></i>Docker</div>
            <div class="d-flex align-items-start flex-column h-100 align-items-center">
              <div class="d-flex col flex-column text-center">
                <div class="border rounded p-4 d-flex flex-column server">
                  <span class="fa-stack mb-4">
                    <i class="fak fa-docker fa-stack-1x color-docker" data-fa-transform="left-12"></i>
                    <i class="fak fa-consul fa-stack-1x color-gray" data-fa-transform="up-22 left-40"></i>
                    <i class="fak fa-nomad fa-stack-1x color-gray" data-fa-transform="up-22 right-40"></i>
                    <i class="fat fa-server fa-4x"></i>
                  </span>
                  <span class="mt-1">docker1</span>
                </div>
              </div>
              <div class="d-flex col flex-column text-center">
                <div class="border rounded p-4 d-flex flex-column server">
                  <span class="fa-stack mb-4">
                    <i class="fak fa-docker fa-stack-1x color-docker" data-fa-transform="left-12"></i>
                    <i class="fak fa-consul fa-stack-1x color-gray" data-fa-transform="up-22 left-40"></i>
                    <i class="fak fa-nomad fa-stack-1x color-gray" data-fa-transform="up-22 right-40"></i>
                    <i class="fat fa-server fa-4x"></i>
                  </span>
                  <span class="mt-1">docker2</span>
                </div>
              </div>
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
              </div>
            </div>
          </div>
        </div>
      </div>
    </main>
  </div>
</body>

</html>