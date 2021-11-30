<?php
$title = "Home";
include("scripts/includes/header.php");

$user = @$_SESSION['logged_user'];
$user_ID = @$user->id;

if(isset($user->id)): ?>

<main>
    <section id="app" class="todo">
        <h1 class="title">Привет, <?php echo $user->login; ?>!</h1>
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
            <h3 class="subtitle">{{title}}</h3>
            <a v-if="!isEmpty" class="todo__add-btn" @click="selectAll()">Выбрать все </a>
            <a v-if="!isEmptyCheckboxList" class="todo__add-btn" @click="uncheckAll()">Снять все</a>
            <a v-if="!isEmptyCheckboxList" class="todo__add-btn" @click="deleteSelected()">Удалить выбранное</a>

            <ul class="todo__list">
                <li class="todo__item" v-for="(item, index) in json" :class="{selected: item.selected}">
                    <label :for="list+index" class="custom-checkbox">
                        
                        <input type="checkbox" :value="item.id" :id="list+index" @click="select(index)" v-model="checkBoxCheckedList" class="custom-checkbox__input">
                        <div class="custom-checkbox__icon"><img src="static/images/tick.svg" alt=""></div>

                        <form class="todo__edit-form" action="scripts/update.php" method="GET" @submit.prevent="edit(item)">
                            <span v-show="!item.active" class="todo__task-name">{{ item.title }}</span>
                            <input v-show="item.active" type="text" ref="edit_task" v-model="item.title" class="todo__task-edit-field">

                            <a v-show="!item.active" href="#!" class="todo__manage-buttons todo__manage-buttons_edit-btn" @click="toggleTaskView(index)"><img src="static/images/pen.png" alt=""></a>
                            <button v-show="item.active" class="todo__manage-buttons todo__manage-buttons_save-btn" type="submit"><img src="static/images/tick.svg" alt=""></button>
                        </form>
                        
                        <a href="#!" class="todo__manage-buttons" @click="del(item)">x</a>
                    </label>
                </li>
            </ul>
            <p v-if="isEmpty" class="empty">{{ text.emptyList }}</p>
            <span @click="toggleClass()" class="todo__add-btn">Добавить задачу +</span>
            <form v-show="isActive" class="add-task-form" action="todo/add.php" method="GET" @submit.prevent="addTask">
                <input class="add-task-form__input" type="text" name="task" placeholder="Помыть посуду" v-model="task">
                <button class="todo__add-btn add-task-form__btn" type="submit">Добавить +</button>
            </form>
            <p class="help" v-if="text.error!='' ">{{ text.error }}</p>
        </div>
    </script>
</main>

<?php
else: header("Location: sign-in.php"); endif;
include("scripts/includes/footer.php");