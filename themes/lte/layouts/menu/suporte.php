<?php

return [
                    ['label' => 'Suporte', 'options' => ['class' => 'header']],
                    ['label' => 'Gii', 'icon' => 'fa fa-file-code-o', 'url' => ['/gii']],
                    ['label' => 'Login', 'url' => ['/user/security/login'], 'visible' => Yii::$app->user->isGuest],
                    ['label' => 'Papéis', 'icon' => 'fa fa-file-code-o', 'url' => ['/rbac/role']],
                    ['label' => 'Atribuições', 'icon' => 'fa fa-file-code-o', 'url' => ['/rbac/assignment']],

            ];