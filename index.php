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
        <p><button class="todo__add-btn logout" @click="logout()"><img width="20" src="static/images/log.svg" alt=""> Выйти из аккаунта</button></p>
    </section>

    <script type="text/x-template" id="todo-list-template">
        <div>
            <h3 class="subtitle">{{title}}</h3>
            <div class="button-group">
                <a v-if="!isEmpty" class="todo__add-btn" @click="checkAll()"><img width="20" src="static/images/select-all.svg" alt="">  <span>Выбрать все</span> </a>
                <a v-if="!isEmptyCheckboxList" class="todo__add-btn" @click="uncheckAll()"><img width="20" src="static/images/uncheck.svg" alt=""> <span>Снять все</span></a>
                <a v-if="!isEmptyCheckboxList" class="todo__add-btn" @click="deleteSelected()"><img width="20" src="static/images/trash.svg" alt=""> <span>Удалить</span></a>
            </div>
            <ul class="todo__list">
                <li class="todo__item" v-for="(item, index) in json" :class="{selected: item.selected}">
                    <label :for="list+index" class="custom-checkbox">
                        
                        <input type="checkbox" :value="item.id" :id="list+index" @click="select(index)" v-model="checkBoxCheckedList" class="custom-checkbox__input">
                        <div class="custom-checkbox__icon"><img src="static/images/tick.svg" alt=""></div>

                        <form class="todo__edit-form" method="GET" @submit.prevent="edit(item)">
                            <span v-show="!item.active" class="todo__task-name">{{ item.title }}</span>
                            <input v-show="item.active" type="text" ref="edit_task" v-model="item.title" class="todo__task-edit-field">

                            <a v-show="!item.active" href="#!" class="todo__manage-buttons todo__manage-buttons_edit-btn" @click="toggleTaskView(index,item)"><img src="static/images/edit.svg" alt=""></a>
                            <button v-show="item.active" class="todo__manage-buttons todo__manage-buttons_save-btn" type="submit"><img src="static/images/tick.svg" alt=""></button>
                        </form>
                        
                        <a href="#!" class="todo__manage-buttons" @click="del(item)"><img src="static/images/cross.svg" alt=""></a>
                    </label>
                </li>
            </ul>
            <p v-if="isEmpty" class="empty">{{ text.emptyList }}</p>
            <span @click="toggleClass()" class="todo__add-btn"> <img width="20" src="static/images/add.svg" alt=""> <span>Добавить задачу</span></span>
            <form v-show="isActive" class="add-task-form" method="GET" @submit.prevent="addTask">
                <input class="add-task-form__input" type="text" name="task" placeholder="Помыть посуду" v-model="task">
                <button class="todo__add-btn add-task-form__btn" type="submit"> <img width="20" src="static/images/add.svg" alt=""> <span>Добавить</span></button>
            </form>
            <p class="help" v-if="text.error!='' "><img width="20" src="static/images/exclamation-mark.svg" alt="">{{ text.error }}</p>
        </div>
    </script>
</main>

<?php
else: header("Location: sign-in.php"); endif;
include("scripts/includes/footer.php");