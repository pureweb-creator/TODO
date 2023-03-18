<?php
$title = "Sign up";
include("scripts/includes/header.php"); ?>

<main>
    <section class="todo" id="reg">
		<?php if(isset($_SESSION['logged_user'])): echo "<br>Вы уже вошли в свой аккаунт. "; else: ?>
		<div class="sign-up">
			<h1 class="sign-up__title text-center">Регистрация</h1>
			<form class="todo__reg-form text-center" id="signUpForm" @submit.prevent="reg()">
				<div class="input-group">
					<input type="text" class="input-group__input" placeholder="Логин" v-model="login">
					<p v-if="response['error']['no_login']" class="help">Введите логин</p>
				</div>
				<div class="input-group">
					<input type="password" class="input-group__input" placeholder="Пароль" v-model="pass">
					<p v-if="response['error']['no_pass']" class="help">Введите пароль</p>
					<p v-if="response['error']['wrong_pass']" class="help">Пароль неверный</p>
				</div>
				<button type="submit" class="todo__add-btn">Зарегистрироваться</button>
				<p v-if="response['error']['same_login']" class="help">Пользователь с таким логином уже зарегистрирован</p>
				<div class="sign-up-link">Уже есть аккаунт? <a href="<?= SITEURL; ?>/sign-in.php"> Войдите!</a> </div>	
			</form>
		</div>
		<?php endif; ?>
	</section>
</main>

<?php
include("scripts/includes/footer.php"); ?>

<script>
    new Vue({
        el: "#reg",
        data:{
            login: '',
            pass: '',
            response: {
            	error: {
            		"same_login": false,
            		"wrong_pass": false,
            		"no_pass": false,
            		"no_login": false
            	}
            }
        },
        methods: {
            reg: function(){
                axios
                    .get('scripts/sign-up/do_sign_up.php?login='+this.login+'&pass='+this.pass)
                    .then(response=>{
                        this.response=response.data

                        console.log(response.data)

                        if(this.response.data=="OK"){
                            window.location.replace("./sign-in.php");
                        }
                    })
                    .catch(error=>console.log(error.data));
            }
        }
    });
</script>