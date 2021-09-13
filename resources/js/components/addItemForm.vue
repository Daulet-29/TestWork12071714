<template>
    <div class="addItem">
        <input v-model="item.name" type="text"/>
        <font-awesome-icon icom="plus-square"
           @click="addItem"
           :class="[item.name ? 'active' : 'inactive', 'plus']"
        />
    </div>
</template>

<script>
export default {
    name: "addItemForm",
    data: function () {
        return {
            item: { name: ''}
        }
    },
    methods: {
        addItem() {
            if (this.item.name == '') {
                return;
            }
            this.axios.post('api/items/store', {
                item: this.item
            })
            .then(response => {
               if (response.status === 201) {
                   this.item.name = ''
                   this.$emit('reloadList')
               }
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
