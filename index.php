<?php
$title = "Home";
include("php/includes/header.php");

$user = @$_SESSION['logged_user'];
$user_ID = @$user->id;

if(isset($user->id)): ?>

<main>
    <section id="app" class="todo">
        <h1>Привет, <?php echo $user->login; ?>!</h1>
        <div class="tasks-wrapper">
            <todo-list list="pages" title="Срочные задачи"></todo-list>
            <todo-list list="news" title="Не срочные задачи"></todo-list>
            <todo-list list="today" title="Задачи на сегодня"></todo-list>
        </div>
        <hr>
        <p><button class="todo__add-btn" @click="logout()">Выйти из аккаунта</button></p>
    </section>

    <script type="text/x-template" id="todo-list-template">
        <div>
            <h3>{{title}}</h3>
            <a v-if="!isEmptyCheckboxList" class="todo__add-btn" @click="selectAll()">Выбрать все </a>
            <a v-if="!isEmptyCheckboxList" class="todo__add-btn" @click="deleteSelected()">Удалить выбранное</a>

            <ul class="todo__list">
                <li class="todo__item" v-for="(item, index) in json">
                    <label :for="list+index" class="custom-checkbox">
                        
                        <input type="checkbox" :value="item.id" v-model="checkBoxCheckedList" class="custom-checkbox__input" :id="list+index">
                        <div class="check"><img src="images/tick.svg" alt=""></div>

                        <form action="php/update.php" method="GET" @submit.prevent="edit(item)">
                            <span v-show="!item.active" class="todo__value">{{ item.title }}</span>
                            <input v-show="item.active" type="text" ref="edit_task" v-model="item.title" class="todo__text">

                            <a href="#!" class="todo__manage-buttons todo__delete" @click="toggleTaskView(index)" v-show="!item.active"><img src="images/pen.png" alt=""></a>
                            <button v-show="item.active" class="todo__manage-buttons todo__add-btn" type="submit">done</button>
                        </form>
                        
                        <a href="#!" class="todo__delete" @click="del(item)">x</a>
                    </label>
                </li>
            </ul>
            <p v-if="isEmpty">{{ text.emptyList }}</p>
            <span @click="toggleClass()" class="todo__add-btn">Добавить задачу +</span>
            <form :class="{active: isActive}" class="todo__add-form " action="todo/add.php" method="GET" @submit.prevent="addTask">
                <input class="todo__input" type="text" name="task" placeholder="Помыть посуду" v-model="task">
                <button class="todo__add-btn mb0" type="submit">Добавить +</button>
            </form>
            <p class="help">{{ text.error }}</p>
        </div>
    </script>
</main>

<?php
else:
    header("Location: sign-in.php");
endif;
include("php/includes/footer.php"); ?>