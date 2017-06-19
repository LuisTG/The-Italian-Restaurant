<?php 
function validateEmail($content){
	$emailPattern = '/^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/';
	return preg_match($emailPattern, $content);
}

function validateTelephone($content){
	$telPattern = '/^[0-9]{10}$/';
	return preg_match($telPattern, $content);
}

function validateNickName($content){
	$nicknamePattern = '/^[a-zA-Z0-9_.-]{1,15}$/';
	return preg_match($nicknamePattern, $content);
}

function validateSimpleText($content){
	$simpletextPattern = '/^[a-zA-Záéíóú]{1,}$/';
	return preg_match($simpletextPattern, $content);
}

function validateTextField($content){
	$usernamePattern = '/^[a-zA-ZA-zÀ-úA-zÀ-ÿ?¿! ¡.,;:]{1,}$/';
	return preg_match($usernamePattern, $content);
}

function validateTextArea($content){
	$textPattern = '/^[a-zA-ZA-zÀ-úA-zÀ-ÿ0-9?¿! ¡.,;:\n]{1,}$/';
	return preg_match($textPattern, $content);
}

function validatePassword($content){
	$passwordPattern = '/^(?=.*?[A-Z])(?=(.*[a-z]){1,})(?=(.*[\d]){1,})(?=(.*[\W]){1,})(?!.*\s).{8,16}$/';
	return preg_match($passwordPattern, $content);
}

function validatePrice($content){
	$pricePattern = '/^([0-9]{0,4})?(.([0-9]{1,2}))?$/';
	return preg_match($pricePattern, $content);
}
?>