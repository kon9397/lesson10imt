<?php

require_once './visualize.php';

$dbname = 'shop';
$user = 'root';
$pass = 'root';

$dbh = new PDO('mysql:host=localhost;dbname=' . $dbname, $user, $pass);

$x = 'bekivan@ukr.net';
$y = 'dfg2341f';

echo '1. достать из базы пользователя с email = $x и паролем = $y';

visualize($dbh->query('SELECT * FROM users WHERE email ="' . $x . '" AND password = "' . $y . '"'));

echo '<hr>';

echo '2. Вывести все даты заказов пользователя с айди = 3';

visualize($dbh->query('SELECT users.name, orders.created_at FROM orders, users WHERE users.id=3 AND orders.user_id = 3'));

echo '<hr>';

echo 'вывести статью адрес(slug) которой $x. Т.е. пользователь переходит по адресу example.com/articles/abous-us в этом случае нам надо';

visualize($dbh->query('SELECT * FROM articles WHERE slug="about-us"'));

echo '<hr>';

echo 'вывести запись из БД где slug=’about-us’';

visualize($dbh->query('SELECT * FROM articles WHERE slug="about-us"'));

echo '<hr>';

echo 'Вывести имя пользователя и телефон с email=$x';

visualize($dbh->query('SELECT name, phone FROM users WHERE email="ivanov@gmail.com"'));

echo '<hr>';

echo 'Вывести сумму к оплате по заказу №4';

visualize($dbh->query('SELECT price FROM orders_to_product WHERE order_id=4'));

echo '<hr>';

echo 'Выбрать все товары с брендом $x и ценой между $a и $b';

visualize($dbh->query('SELECT * FROM products WHERE brand="Apple" AND price BETWEEN 10000 AND 20000'));

echo '<hr>';

echo 'вывести всех пользователей зарегистрированных за текущий месяц';

visualize($dbh->query('SELECT * FROM `users` WHERE `created_at` BETWEEN \'2020-12-01\' AND \'2020-12-31\' ORDER BY `created_at` DESC'));

echo '<hr>';

echo 'вывести количество статей на сайте';

visualize($dbh->query('SELECT COUNT(*) FROM articles'));

echo '<hr>';

echo 'Вывести средний чек(средняя сумма заказов) по сайту';

visualize($dbh->query('SELECT AVG(price) FROM orders_to_product'));

echo '<hr>';

echo 'вывести все товары который когда-либо покупал пользователь №2';

visualize($dbh->query('SELECT products.name, products.articul, products.brand, products.description, products.price FROM products INNER JOIN orders_to_product on orders_to_product.id = products.id INNER JOIN orders on orders.id = orders_to_product.order_id INNER JOIN users on users.id = orders.user_id WHERE users.id = 2'));

echo '<hr>';

echo 'вывести категории по которым не было ни одного заказа';

visualize($dbh->query("SELECT DISTINCT categories.name FROM categories JOIN products on categories.id = products.category_id WHERE products.id NOT IN (SELECT product_id FROM orders_to_product)"));