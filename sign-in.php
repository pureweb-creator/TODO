<?php
$title = "Sign in";
include("php/includes/header.php") ?>


<main>
    <section class="todo" id="auth">
		<?php if(isset($_SESSION['logged_user'])): header("Location: ./"); else: ?>
		<div class="sign-up">
			<h1 class="sign-up__title text-center">Авторизация</h1>
			<form class="todo__reg-form text-center" id="signUpForm" @submit.prevent="reg()">
				<div class="form-group">
					<input type="text" class="todo__input" placeholder="Логин" v-model="login">
				</div>
				<div class="form-group">
					<input type="password" class="todo__input" placeholder="Пароль" v-model="pass">
				</div>
				<button type="submit" class="todo__add-btn">Войти</button>
				<p>{{ response.data }}</p>
				<div class="sign-up-link">Еще не с нами? <a href="<?php echo SITEURL; ?>/sign-up.php"> Зарегистрируйтесь!</a> </div>	
			</form>
		</div>
		<?php endif; ?>
	</section>
</main>

<?php
include("php/includes/footer.php");