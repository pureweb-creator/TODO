Vue.component('todo-list', {
    template: '#todo-list-template',
    data() {
        return {
            json: [],
            task: '',
            newTask: '',
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
        }
    },
    methods: {
        toggleClass: function (){
            return this.isActive = !this.isActive
        },
        toggleReadOnly: function(index){
            let item = this.json[index]
            item.active = !item.active
            this.$set(this.json, index, item) 
        },
        read: function(){
            fetch('php/handle.php?table='+this.list)
            .then(r=>r.json())
            .then(json => {
                this.json=json
            });
        },
        del: function(index){
            let id = index.id

            this.json.forEach((element, index) => {
                if(element.id == id) this.$delete(this.json,index)
            })
            fetch('php/delete.php?id='+index.id+'&table='+this.list)
        },
        edit: function(index){
            if(this.newTask.length == 0){
                this.text.error = "Ошибка! Пустое поле."
                return false
            }
            this.text.error = ""

            fetch('php/edit.php?table='+this.list+"&id="+index.id+"&task="+this.newTask)
            this.read()
            this.newTask = ""
        },
        addTask: function(){
            if(!this.task){
                this.text.error = "Ошибка! Пустое поле."
                return false
            }
            this.text.error = ""

            fetch('php/add.php?task='+this.task+"&table="+this.list)
            
            this.read()
            this.task = ""
        }
    },
    created: function () {
        this.read()
    }
});

new Vue({
    el: "#app"
});