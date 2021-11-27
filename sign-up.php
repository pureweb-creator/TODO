<?php
$title = "Sign up";
include("php/includes/header.php"); ?>

<main>
    <section class="todo" id="reg">
		<?php if(isset($_SESSION['logged_user'])): echo "<br>Вы уже вошли в свой аккаунт. "; else: ?>
		<div class="sign-up">
			<h1 class="sign-up__title text-center">Регистрация</h1>
			<form class="todo__reg-form text-center" id="signUpForm" @submit.prevent="reg()">
				<div class="form-group">
					<input type="text" class="todo__input" placeholder="Логин" v-model="login">
				</div>
				<div class="form-group">
					<input type="password" class="todo__input" placeholder="Пароль" v-model="pass">
				</div>
				<button type="submit" class="todo__add-btn">Зарегистрироваться</button>
				<p>{{ response }}</p>
				<div class="sign-up-link">Уже есть аккаунт? <a href="<?php echo SITEURL; ?>/sign-in.php"> Войдите!</a> </div>	
			</form>
		</div>
		<?php endif; ?>
	</section>
</main>

<?php
include("php/includes/footer.php");