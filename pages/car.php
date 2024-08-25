<?php
session_start();
include "../db_conn.php";

$search_term = $_GET['id'];
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$sql = "
    SELECT vehicles.*, consignee.firstname AS consignee_name, consignee.lastname AS consignee_lname, consignee.personal_id AS consignee_personal 
    FROM vehicles 
    INNER JOIN consignee ON vehicles.consigne_id = consignee.id WHERE vehicles.id='$search_term'
";

$result = $conn->query($sql);

$dealers = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $dealers[] = $row;
    }
}
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vehicle Details | Admin Panel</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Swiper/6.8.4/swiper-bundle.min.css">
    <link rel="stylesheet" href="assets/css/portal.css?v=<?php echo time(); ?>">
    <style>
        body {
            font-family: Arial, sans-serif;
            color: #333;
            background-color: #f5f5f5;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 100%;
            margin: 0 auto;
            padding: 20px;
        }

        .swiper-container {
            width: 100%;
            height: auto;
            margin-bottom: 20px;
        }

        .swiper-slide img {
            width: 100%;
            height: auto;
            object-fit: cover;
        }

        .details-list {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .details-list li {
            margin-bottom: 15px;
            font-size: 16px;
            display: flex;
            justify-content: space-between;
            background: #fff;
            padding: 10px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            box-sizing: border-box;
        }

        .details-list li strong {
            font-weight: bold;
        }

        .tab-content img {
            width: 100%;
            height: auto;
        }

        .nav-pills .nav-link {
            border-radius: 8px;
            padding: 10px;
            text-align: center;
        }

        .nav-link.active {
            background-color: #007bff;
            color: #fff;
        }

        @media (max-width: 767.98px) {
            .details-list li {
                flex-direction: column;
                align-items: flex-start;
                font-size: 14px;
            }

            .details-list li strong {
                margin-bottom: 5px;
            }

            .swiper-container {
                height: 200px; /* Adjust height as needed */
            }
        }
    </style>
</head>
<body>
    <?php if (isset($_SESSION['username']) && isset($_SESSION['id'])): ?>
    <header class="app-header fixed-top">
        <div class="app-header-inner">
            <div class="container-fluid py-2">
                <div class="app-header-content">
                    <div class="row justify-content-between align-items-center">
                        <div class="col-auto">
                            <?php include "../add_balance.php"; ?>
                            <a id="sidepanel-toggler" class="sidepanel-toggler d-inline-block d-xl-none" href="#">
                                <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 30 30" role="img">
                                    <title>Menu</title>
                                    <path stroke="currentColor" stroke-linecap="round" stroke-miterlimit="10" stroke-width="2" d="M4 7h22M4 15h22M4 23h22"></path>
                                </svg>
                            </a>
                        </div>
                        <div class="app-utilities col-auto">
                            <?php include "../balance.php"; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div id="app-sidepanel" class="app-sidepanel">
            <div id="sidepanel-drop" class="sidepanel-drop"></div>
            <div class="sidepanel-inner d-flex flex-column">
                <a href="#" id="sidepanel-close" class="sidepanel-close d-xl-none">&times;</a>
                <div class="app-branding">
                    <a class="app-logo" href="/"><img class="logo-icon me-2" src="assets/images/app-logo.svg" alt="logo"><span class="logo-text">PORTAL</span></a>
                </div>
                <?php include "../sidebar.php"; ?>
                <?php include "../footer.php"; ?>
            </div>
        </div>
    </header>
    <?php endif; ?>
    <div class="app-wrapper">
        <main class="app-content pt-3 p-md-3 p-lg-4">
            <div class="container">
                <div class="row mb-4 mt-4">
                    <div class="col-12">
                        <h2><?php echo htmlspecialchars($dealers[0]["year"] . " " . $dealers[0]["make"] . " " . $dealers[0]["model"]); ?></h2>
                        <ul class="details-list">
                            <li>
                                <strong>Price:</strong>
                                <span>$<?php echo htmlspecialchars($dealers[0]["price"]); ?></span>
                            </li>
                            <li>
                                <strong>Auction:</strong>
                                <span><?php echo htmlspecialchars($dealers[0]["auction"]); ?></span>
                            </li>
                            <li>
                                <strong>Lot:</strong>
                                <span><?php echo htmlspecialchars($dealers[0]["lot"]); ?></span>
                            </li>
                            <li>
                                <strong>Branch:</strong>
                                <span><?php echo htmlspecialchars($dealers[0]["branch"]); ?></span>
                            </li>
                            <li>
                                <strong>Date:</strong>
                                <span><?php echo htmlspecialchars($dealers[0]["dt"]); ?></span>
                            </li>
                            <li>
                                <strong>Insurance:</strong>
                                <span><?php echo ($dealers[0]["insurance"] == 'loss') ? 'Total loss' : 'Full cover'; ?></span>
                            </li>
                            <li>
                                <strong>Consignee:</strong>
                                <span><?php echo htmlspecialchars($dealers[0]["consignee_name"] . " " . $dealers[0]["consignee_lname"]); ?></span>
                            </li>
                            <li>
                                <strong>Personal ID:</strong>
                                <span><?php echo htmlspecialchars($dealers[0]["consignee_personal"]); ?></span>
                            </li>
                            <li>
                                <strong>Status:</strong>
                                <span><?php echo htmlspecialchars($dealers[0]["status"]); ?></span>
                            </li>
                            <li>
                                <strong>Booking ID:</strong>
                                <span><?php echo htmlspecialchars($dealers[0]["booking_id"]); ?></span>
                            </li>
                            <li>
                                <strong>Container ID:</strong>
                                <span><?php echo htmlspecialchars($dealers[0]["container_id"]); ?></span>
                            </li>
                            <li>
                                <strong>Port of Load:</strong>
                                <span><?php echo htmlspecialchars($dealers[0]["container_name"]); ?></span>
                            </li>
                            <li>
                                <strong>Debt:</strong>
                                <span>$<?php echo htmlspecialchars($dealers[0]["debt"]); ?></span>
                            </li>
                            <li>
                                <strong>Has Key:</strong>
                                <span><?php echo htmlspecialchars($dealers[0]["has_key"]); ?></span>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <ul class="nav nav-pills mb-4" id="pills-tab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <a class="nav-link active" id="pills-home-tab" data-bs-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">Pick Up</a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link" id="pills-profile-tab" data-bs-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false">Warehouse</a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link" id="pills-contact-tab" data-bs-toggle="pill" href="#pills-contact" role="tab" aria-controls="pills-contact" aria-selected="false">Georgia</a>
                            </li>
                        </ul>
                        <div class="tab-content" id="pills-tabContent">
                            <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                                <div class="swiper-container swiper-container-pickup">
                                    <div class="swiper-wrapper">
                                        <?php if (!empty($dealers[0]["pickup"])): ?>
                                            <?php foreach (explode(',', $dealers[0]["pickup"]) as $path): ?>
                                                <div class="swiper-slide">
                                                    <img src="<?= htmlspecialchars($path) ?>" alt="Pick Up Image">
                                                </div>
                                            <?php endforeach; ?>
                                        <?php endif; ?>
                                    </div>
                                    <div class="swiper-button-prev"></div>
                                    <div class="swiper-button-next"></div>
                                    <div class="swiper-pagination"></div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                                <div class="swiper-container swiper-container-warehouse">
                                    <div class="swiper-wrapper">
                                        <?php if (!empty($dealers[0]["warehouse"])): ?>
                                            <?php foreach (explode(',', $dealers[0]["warehouse"]) as $path): ?>
                                                <div class="swiper-slide">
                                                    <img src="<?= htmlspecialchars($path) ?>" alt="Warehouse Image">
                                                </div>
                                            <?php endforeach; ?>
                                        <?php endif; ?>
                                    </div>
                                    <div class="swiper-button-prev"></div>
                                    <div class="swiper-button-next"></div>
                                    <div class="swiper-pagination"></div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">
                                <div class="swiper-container swiper-container-georgia">
                                    <div class="swiper-wrapper">
                                        <?php if (!empty($dealers[0]["georgia"])): ?>
                                            <?php foreach (explode(',', $dealers[0]["georgia"]) as $path): ?>
                                                <div class="swiper-slide">
                                                    <img src="<?= htmlspecialchars($path) ?>" alt="Georgia Image">
                                                </div>
                                            <?php endforeach; ?>
                                        <?php endif; ?>
                                    </div>
                                    <div class="swiper-button-prev"></div>
                                    <div class="swiper-button-next"></div>
                                    <div class="swiper-pagination"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
    <script src="assets/plugins/popper.min.js"></script>
    <script src="assets/plugins/bootstrap/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/6.8.4/swiper-bundle.min.js"></script>
    <script src="assets/js/app.js?v=<?php echo time(); ?>"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const swipers = [
                new Swiper('.swiper-container-pickup', {
                    slidesPerView: 1,
                    spaceBetween: 10,
                    loop: true,
                    navigation: {
                        nextEl: '.swiper-button-next',
                        prevEl: '.swiper-button-prev',
                    },
                    pagination: {
                        el: '.swiper-pagination',
                        clickable: true,
                    },
                    breakpoints: {
                        768: {
                            slidesPerView: 1,
                            spaceBetween: 10,
                        },
                        1024: {
                            slidesPerView: 2,
                            spaceBetween: 20,
                        }
                    }
                }),
                new Swiper('.swiper-container-warehouse', {
                    slidesPerView: 1,
                    spaceBetween: 10,
                    loop: true,
                    navigation: {
                        nextEl: '.swiper-button-next',
                        prevEl: '.swiper-button-prev',
                    },
                    pagination: {
                        el: '.swiper-pagination',
                        clickable: true,
                    },
                    breakpoints: {
                        768: {
                            slidesPerView: 1,
                            spaceBetween: 10,
                        },
                        1024: {
                            slidesPerView: 2,
                            spaceBetween: 20,
                        }
                    }
                }),
                new Swiper('.swiper-container-georgia', {
                    slidesPerView: 1,
                    spaceBetween: 10,
                    loop: true,
                    navigation: {
                        nextEl: '.swiper-button-next',
                        prevEl: '.swiper-button-prev',
                    },
                    pagination: {
                        el: '.swiper-pagination',
                        clickable: true,
                    },
                    breakpoints: {
                        768: {
                            slidesPerView: 1,
                            spaceBetween: 10,
                        },
                        1024: {
                            slidesPerView: 2,
                            spaceBetween: 20,
                        }
                    }
                })
            ];

            document.querySelectorAll('a[data-bs-toggle="pill"]').forEach((tab) => {
                tab.addEventListener('shown.bs.tab', function () {
                    swipers.forEach(swiper => swiper.update());
                });
            });

            // var sessionVariable = <?php echo json_encode(isset($_SESSION['username'])); ?>;    
            // var appWrapper = document.querySelector('.app-wrapper');
            // appWrapper.style.marginLeft = sessionVariable ? '250px' : '0'; 
        });
    </script>
</body>
</html>