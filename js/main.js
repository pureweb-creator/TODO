Vue.component('todo-list', {
    template: '#todo-list-template',
    data() {
        return {
            json: [],
            task: '',
            newTask: '',
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
        toggleReadOnly: function(index){
            let item = this.json[index]
            item.active = !item.active
            this.$set(this.json, index, item) 
        },
        deleteSelected: function(){
            console.log(this.checkBoxCheckedList)
            axios.get('php/deleteMultiple.php?table='+this.list+'&id='+this.checkBoxCheckedList)
                .then(response=>console.log(response.data))            
            this.read()
            this.task = ""
            this.checkBoxCheckedList = []
        },
        selectAll: function(){
            this.json.forEach(element => {
                this.checkBoxCheckedList.push(element.id)
            });
        },
        read: function(){
            axios
                .get('php/handle.php?table='+this.list)
                .then(response=>this.json=response.data)
                .catch(error=>console.log(error))
        },
        del: function(index){
            axios.get('php/delete.php?id='+index.id+'&table='+this.list)
            this.read()
            this.task = ""
        },
        edit: function(index){
            if(this.newTask.length == 0){
                this.text.error = "Ошибка! Пустое поле."
                return false
            }
            this.text.error = ""
            
            axios.get('php/edit.php?table='+this.list+"&id="+index.id+"&task="+this.newTask)
            this.read()
            this.newTask = ""
        },
        addTask: function(){
            if(!this.task){
                this.text.error = "Ошибка! Пустое поле."
                return false
            }
            this.text.error = ""

            axios.get('php/add.php?task='+this.task+"&table="+this.list)   
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