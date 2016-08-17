<?php

use yii\bootstrap\Nav;


echo Nav::widget([
                'options' => ['class' => 'navbar-nav', 'style' => 'text-align: center','id' => 'my-menu'],
                'items' => [
                    ['label' => 'HOME', 'url' => ['/site/index','cat' => 0]],
                    ['label' => 'BRAND', 'url' => ['/site/index', 'cat' => 3]],
                    ['label' => 'EVENT', 'url' => ['/site/index', 'cat' => 2]],
                    ['label' => 'FASHION', 'url' => ['/site/index','cat' => 5]],
                    ['label' => 'FOOD', 'url' => ['/site/index','cat' => 1]],
                    ['label' => 'LIFE', 'url' => ['/site/index', 'cat' => 4]],
                    ['label' => 'TRAVEL', 'url' => ['/site/index', 'cat' => 6]],
                    ['label' => 'CONTACT US', 'url' => ['/site/contact']],
                    ['label' => 'CONTROL PANEL', 'url' => ['/artikel/index'], 'visible' => !Yii::$app->user->isGuest],
                    Yii::$app->user->isGuest ?
                        ['label' => 'LOGIN', 'url' => ['/site/login']] :
                        ['label' => 'LOGOUT (' . Yii::$app->user->identity->username . ')',
                            'url' => ['/site/logout'],
                            'linkOptions' => ['data-method' => 'post']],
                ],
                ]);