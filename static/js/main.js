Vue.component('todo-list', {
    template: '#todo-list-template',
    data() {
        return {
            json: [],
            task: '',
            checkBoxChecked: false,
            checkBoxCheckedList: [],
            isActive: false,
            isReadOnly: true,
            text:{
                error: "",
                emptyList: "Список пуст."
            }
        }
    },
    props: {
        list: {required: true},
        title: {required: true}
    },
    computed: {
        isEmpty: function() {
            return this.json.length == 0
        },
        isEmptyCheckboxList: function(){
            return this.checkBoxCheckedList.length == 0
        }
    },
    methods: {
        toggleClass: function (){
            return this.isActive = !this.isActive
        },
        toggleTaskView: function(index){
            let item = this.json[index]
            item.active = !item.active
            this.$set(this.json, index, item)
            this.$nextTick(() => this.$refs.edit_task[index].focus())
        },
        deleteSelected: function(){
            axios.get('scripts/delete.php?table='+this.list+'&id='+this.checkBoxCheckedList)
                .then(response=>console.log(response.data))            
            this.read()
            this.task = ""
            this.checkBoxCheckedList = []
        },
        select: function(element){
            let item = this.json[element]
            item.selected = !item.selected
            this.$set(this.json, element, item)
        },
        // По нажатию на кнопку "выбрать все", скриптом пушим в массив все чекбоксы.
        selectAll: function(){
            this.json.forEach(element => {
                this.checkBoxCheckedList.push(element.id)
                element.selected = true
            });
        },
        uncheckAll: function(){
            this.json.forEach(element => {
                this.checkBoxCheckedList.splice(element)
                element.selected = false
            })
        },
        read: function(){
            // Один раз почему-то  очень плохо работает..
            for (let i = 0; i < 2; i++) {
                axios
                    .get('scripts/handle.php?table='+this.list)
                    .then(response=>this.json=response.data)
                    .catch(error=>console.log(error))    
            }
            
        },
        del: function(index){
            axios.get('scripts/delete.php?id='+index.id+'&table='+this.list)
            this.read()
            this.task = ""
        },
        edit: function(index){
            if(index.title.length == 0){
                this.text.error = "Ошибка! Пустое поле."
                return false
            }
            this.text.error = ""
            
            axios.get('scripts/edit.php?table='+this.list+"&id="+index.id+"&task="+index.title)
            this.read()
            index.title = ""
        },
        addTask: function(){
            if(!this.task){
                this.text.error = "Ошибка! Пустое поле."
                return false
            }
            this.text.error = ""

            axios.get('scripts/add.php?task='+this.task+"&table="+this.list)
            this.read()
            this.task = ""
        }
    },
    created: function () {
        this.read()
    }
});

new Vue({
    el: "#app",
    methods: {
        logout: function(){
            axios
                .get('scripts/sign-up/logout.php')
                .then(response=>console.log(response.data))
                .catch(error=>console.log(error.data));
            window.location.href = './sign-in.php';
        }
    }
});

