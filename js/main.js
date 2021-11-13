Vue.component('todo-list', {
    template: '#todo-list-template',
    data() {
        return {
            json: [],
            task: '',
            isActive: false,
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
        del: function(index){
            let id = index.id

            this.json.forEach((element, index) => {
                if(element.id == id) this.$delete(this.json,index)
            })
            fetch('php/delete.php?id='+index.id+'&table='+this.list)
        },
        addTask: function(){
            if(!this.task){
                this.text.error = "Ошибка"
                return false
            }
            this.text.error = ""

            fetch('php/add.php?task='+this.task+"&table="+this.list)
            fetch('php/handle.php?table='+this.list)
                .then(r=>r.json())
                .then(json => {
                    this.json=json
                });
            this.task = ""
        }
    },
    created: function () {
        fetch('php/handle.php?table='+this.list)
            .then(r=>r.json())
            .then(json => {
                this.json=json
            });
    }
});

new Vue({
    el: "#app"
});