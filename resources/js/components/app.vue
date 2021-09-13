<template>
    <div class="todoListContainer">
        <div class="heading">
            <h2 id="title">Todo List</h2>
            <add-item-form v-on:reloadList="getList()"/>
        </div>
        <list-item
            :items="items"
            v-on:reloadList="getList()"
        />
    </div>
</template>

<script>
import listItem from  './list-item.vue'
import addItemForm from  './addItemForm.vue'
export default {
    name: "app",
    components: {
        listItem,
        addItemForm
    },
    data: function () {
        return {
            items: []
        }
    },
    methods: {
        getList() {
            this.axios.get('api/items')
            .then(response => {
                this.items = response.data
            })
            .catch(error => {
                console.log(error)
            })
        }
    }
}
</script>

<style scoped>

</style>
