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
                    <a href="<?= Yii::$app->urlManager->createUrl(['/cp/visit'])?>" class="dropdown-toggle no-arrow <?= Yii::$app->controller->id == 'visit' ? 'active' : ''?>">
                        <span class="micon bi bi-list-check"></span>
                        <span class="mtext">Tashriflar</span>
                    </a>
                </li>

                <li class="dropdown">
                    <a href="javascript:;" class="dropdown-toggle">
                        <span class="micon bi bi-gear-fill"></span>
                        <span class="mtext">Kassa</span>
                    </a>
                    <ul class="submenu">
                        <li>
                            <a href="<?= Yii::$app->urlManager->createUrl(['/cp/client-paid'])?>" class="dropdown-toggle no-arrow <?= (Yii::$app->controller->id == 'client-paid') ? 'active' : ''?>">
                                <span class="mtext">Tushumlar</span>
                            </a>
                        </li>
                        <li><a class="<?= (Yii::$app->controller->id == 'doctor-paid') ? 'active' : ''?>" href="<?= Yii::$app->urlManager->createUrl(['/cp/doctor-paid'])?>">Doktorlarga to`lovlar</a></li>
                        <li><a class="<?= (Yii::$app->controller->id == 'referal-paid') ? 'active' : ''?>" href="<?= Yii::$app->urlManager->createUrl(['/cp/referal-paid'])?>">Hamkorlarga to`lovlar</a></li>
                        <li><a class="<?= (Yii::$app->controller->id == 'other-paid') ? 'active' : ''?>" href="<?= Yii::$app->urlManager->createUrl(['/cp/other-paid'])?>">Boshqa to'lovlar</a></li>
                    </ul>
                </li>

                <li class="dropdown">
                    <a href="javascript:;" class="dropdown-toggle">
                        <span class="micon bi bi-people"></span>
                        <span class="mtext">Mijozlar</span>
                    </a>
                    <ul class="submenu">
                        <li><a class="<?= (Yii::$app->controller->id == 'client'
                                and Yii::$app->controller->action->id != 'credit'
                                and Yii::$app->controller->action->id != 'debt'
                            ) ? 'active' : ''?>" href="<?= Yii::$app->urlManager->createUrl(['/cp/client'])?>">Mijozlar ro'yhati</a></li>
                        <li><a class="<?= (Yii::$app->controller->id == 'client'
                                and Yii::$app->controller->action->id == 'credit'
                            ) ? 'active' : ''?>" href="<?= Yii::$app->urlManager->createUrl(['/cp/client/credit'])?>">Qarzdorlar</a></li>
                        <li><a class="<?= (Yii::$app->controller->id == 'client'
                                and Yii::$app->controller->action->id == 'debt'
                            ) ? 'active' : ''?>" href="<?= Yii::$app->urlManager->createUrl(['/cp/client/debt'])?>">Ortiqcha to'laganlar</a></li>

                        <li><a class="<?= Yii::$app->controller->id == 'client-group' ? 'active' : ''?>" href="<?= Yii::$app->urlManager->createUrl(['/cp/client-group'])?>">Mijoz guruhlari</a></li>
                    </ul>
                </li>

                <li>
                    <a href="<?= Yii::$app->urlManager->createUrl(['/cp/service'])?>" class="dropdown-toggle no-arrow <?= Yii::$app->controller->id == 'service' ? 'active' : ''?>">
                        <span class="micon bi bi-list"></span>
                        <span class="mtext">Xizmatlar</span>
                    </a>
                </li>

                <li>
                    <a href="javascript:;" class="dropdown-toggle">
                        <span class="micon bi bi-person"></span>
                        <span class="mtext">Foydalanuvchilar</span>
                    </a>
                    <ul class="submenu">
                        <li>
                            <a href="<?= Yii::$app->urlManager->createUrl(['/cp/user'])?>" class="dropdown-toggle no-arrow <?= (Yii::$app->controller->id == 'user') ? 'active' : ''?>">
                                <span class="mtext">Foydalanuvchilar</span>
                            </a>
                        </li>
                        <li><a class="<?= Yii::$app->controller->id == 'referal' ? 'active' : ''?>" href="<?= Yii::$app->urlManager->createUrl(['/cp/referal'])?>">Hamkorlar</a></li>
                    </ul>
                </li>



                <li class="dropdown">
                    <a href="javascript:;" class="dropdown-toggle">
                        <span class="micon bi bi-gear-fill"></span>
                        <span class="mtext">Sozlamalar</span>
                    </a>
                    <ul class="submenu">

                        <li><a class="<?= (Yii::$app->controller->id == 'payment') ? 'active' : ''?>" href="<?= Yii::$app->urlManager->createUrl(['/cp/payment'])?>">To'lov turlari</a></li>
                        <li><a class="<?= (Yii::$app->controller->id == 'departament') ? 'active' : ''?>" href="<?= Yii::$app->urlManager->createUrl(['/cp/departament'])?>">Bo`limlar</a></li>
                        <li><a class="<?= (Yii::$app->controller->id == 'room') ? 'active' : ''?>" href="<?= Yii::$app->urlManager->createUrl(['/cp/room'])?>">Xonalar</a></li>
                        <li><a class="<?= (Yii::$app->controller->id == 'other-paid-group') ? 'active' : ''?>" href="<?= Yii::$app->urlManager->createUrl(['/cp/other-paid-group'])?>">Boshqa xarajat guruhlari</a></li>
                        <li><a class="<?= (Yii::$app->controller->id == 'source') ? 'active' : ''?>" href="<?= Yii::$app->urlManager->createUrl(['/cp/source'])?>">Eshitilgan manbalar</a></li>
                        <li><a class="<?= (Yii::$app->controller->id == 'loc-region') ? 'active' : ''?>" href="<?= Yii::$app->urlManager->createUrl(['/cp/loc-region'])?>">Viloyatlar</a></li>
                        <li><a class="<?= (Yii::$app->controller->id == 'loc-district') ? 'active' : ''?>" href="<?= Yii::$app->urlManager->createUrl(['/cp/loc-district'])?>">Tumanlar</a></li>
                    </ul>
                </li>

            </ul>
        </div>
    </div>
</div>


<div class="mobile-menu-overlay"></div>
