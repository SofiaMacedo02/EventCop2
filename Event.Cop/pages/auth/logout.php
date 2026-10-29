<?php
require_once __DIR__ . '/../../includes/bootstrap.php';

logout_mock();
flash('info', 'Você saiu da sua conta.');
redirect_to('home');
