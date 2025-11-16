<div class="left-side-bar">
    <div class="brand-logo">
        <a  href="<?= Yii::$app->urlManager->createUrl(['/cp/'])?>">
            <img src="/mbos.svg" alt="" style="height: 100%" class="dark-logo" />
            <img
                src="/mbos.svg"
                alt=""
                class="light-logo"
            />
        </a>
        <div class="close-sidebar" data-toggle="left-sidebar-close">
            <i class="ion-close-round"></i>
        </div>
    </div>
    <div class="menu-block customscroll">
        <div class="sidebar-menu">
            <ul id="accordion-menu">

                <li>
                    <a href="<?= Yii::$app->urlManager->createUrl(['/cp/'])?>" class="dropdown-toggle no-arrow <?= Yii::$app->controller->id == 'default' ? 'active' : ''?>">
                        <span class="micon bi bi-house"></span>
                        <span class="mtext">Dashboard</span>
                    </a>
                </li>


                <li>
                    <a href="<?= Yii::$app->urlManager->createUrl(['/cp/car'])?>" class="dropdown-toggle no-arrow <?= Yii::$app->controller->id == 'car' ? 'active' : ''?>">
                        <span class="micon bi bi-door-open-fill"></span>
                        <span class="mtext">Kirish/chiqishlar</span>
                    </a>
                </li>


                <li>
                    <a href="<?= Yii::$app->urlManager->createUrl(['/cp/client-paid'])?>" class="dropdown-toggle no-arrow <?= Yii::$app->controller->id == 'client-paid' ? 'active' : ''?>">
                        <span class="micon bi bi-card-checklist"></span>
                        <span class="mtext">Mijoz to'lovlari</span>
                    </a>
                </li>



                <li>
                    <a href="<?= Yii::$app->urlManager->createUrl(['/cp/payment'])?>" class="dropdown-toggle no-arrow <?= Yii::$app->controller->id == 'payment' ? 'active' : ''?>">
                        <span class="micon bi bi-cash"></span>
                        <span class="mtext">To'lov turlari</span>
                    </a>
                </li>


                <li>
                    <a href="<?= Yii::$app->urlManager->createUrl(['/cp/car-type'])?>" class="dropdown-toggle no-arrow <?= Yii::$app->controller->id == 'car-type' ? 'active' : ''?>">
                        <span class="micon fa fa-car"></span>
                        <span class="mtext">Moshina turlari</span>
                    </a>
                </li>

                <li>
                    <a href="<?= Yii::$app->urlManager->createUrl(['/cp/client'])?>" class="dropdown-toggle no-arrow <?= Yii::$app->controller->id == 'client' ? 'active' : ''?>">
                        <span class="micon bi bi-person-check"></span>
                        <span class="mtext">Mijozlar mashinalari</span>
                    </a>
                </li>

                <li>
                    <a href="<?= Yii::$app->urlManager->createUrl(['/cp/user'])?>" class="dropdown-toggle no-arrow <?= Yii::$app->controller->id == 'user' ? 'active' : ''?>">
                        <span class="micon bi bi-person"></span>
                        <span class="mtext">Foydalanuvchilar</span>
                    </a>
                </li>





            </ul>
        </div>
    </div>
</div>


<div class="mobile-menu-overlay"></div>
