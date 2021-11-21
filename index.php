<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inconsolata&display=swap" rel="stylesheet">
    <title>My Todo list</title>
</head>
<body>
    <main>
        <section id="app" class="todo">
            <h1>Список дел</h1>
            <todo-list list="pages" title="Срочные задачи"></todo-list>
            <todo-list list="news" title="Не срочные задачи"></todo-list>
        </section>

        <script type="text/x-template" id="todo-list-template">
            <div>
                <h3>{{title}}</h3>
                <a v-if="!isEmptyCheckboxList" class="todo__add-btn" @click="selectAll()">Select All </a>
                <a v-if="!isEmptyCheckboxList" class="todo__add-btn" @click="deleteSelected()">Delete selected</a>

                <ul class="todo__list">
                    <li class="todo__item" v-for="(item, index) in json">
                        

                        <label :for="index" class="custom-checkbox">
                            <input type="checkbox" :value="item.id" v-model="checkBoxCheckedList" class="custom-checkbox__input" :id="index">
                            <div class="check">
                                <img src="images/tick.svg" alt="">
                            </div>

                            <form action="php/update.php" method="GET" @submit.prevent="edit(item)">
                                <span v-if="!item.active" class="todo__value">{{ item.title }}</span>
                                <input v-if="item.active" type="text" v-model="newTask" :readonly="!item.active" class="todo__text">

                                <a href="#!" class="todo__manage-buttons todo__delete" @click="toggleReadOnly(index)" v-if="!item.active"><img src="images/pen.png" alt=""></a>
                                <button v-if="item.active" class="todo__manage-buttons todo__add-btn" type="submit">done</button>
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

    <style>
        body{
            background: #f0ffff;
            margin: 0;
            padding: 0;
            font-family: 'Inconsolata', monospace;
        }
        ul,li{
            list-style: none;
            margin: 0;
            padding: 0;
        }
        input[type="checkbox"]{
            display: none
        }
        svg{
            display: block;
            width: 30px;
        }
        .custom-checkbox{
            display: flex;
            cursor: pointer;
            align-items: center;
            justify-content: space-between;
            width: 100%;
        }
        .check{
            width: 15px;
            height: 15px;
            border: 2px solid #333;
            border-radius: 5px;
            background: #fff;
            margin-right: 10px;
            padding: 2px;
        }
        img{
            max-width: 100%;
            width: auto;
        }
        .check img{
            display: none
        }
        input:checked + .check img{
            display: block
        }
        main{
            max-width: 500px;
            width: 100%;
            margin: 0 auto;
            margin-top: 100px;
            background: #fff;
            padding: 20px;
            border-radius: 15px;
            box-shadow: 2px 2px 50px #ccc;
        }

        .todo__item{
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 10px 10px;
            background: bisque;
            border-radius: 5px;
            margin-bottom: 10px;
            position: relative;
        }

        .todo__item:hover{
            background: #cfbaa1
        }

        .todo__delete{
            text-decoration: none;
            color: #000;
            background: #fff;
            display: inline-flex;
            width: 25px;
            height: 25px;
            text-align: center;
            line-height: 25px;
            border-radius: 100px;
            flex-shrink: 0;
            justify-content: center;
            align-items: center;
        }

        .todo__delete img{
            max-width: 80%
        }


        .todo__add-form{
            display: none;
            margin-bottom: 15px;
        }

        .todo__add-form.active{
            display: block;
        }

        .todo__add-btn{
            background: azure;
            padding: 10px;
            border-radius: 5px;
            display: inline-block;
            cursor: pointer;
            border: none;

            margin-bottom: 15px;
        }

        .todo__add-btn:hover{
            background: #cadbdb;
        }

        .mb0{
            margin-bottom: 0;
        }

        .todo__input{
            outline: none;
            padding: 8px;
            border-radius: 5px;
            border: 1px solid silver
        }

        .todo__text[readonly],
        .todo__text[disabled]{
            background: transparent;
            border: unset;
        }
        .todo__text{
            background: transparent;
            outline: none;
            border: none;
            border-bottom: 1px solid #000;
        }
        .todo__value{
            left: 0px;
            top: 0px;
        }

        .todo__manage-buttons{
            position: absolute;
            right: 50px;
            top: 50%;
            transform: translateY(-50%);
        }

        form{
            display: block;
            width: 100%;
        }
        span,a{
            display: block
        }
    </style>
    
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/vue@2.6.14/dist/vue.js"></script>
    <script src="js/main.js"></script>
</body>
</html>