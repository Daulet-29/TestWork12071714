<template>
    <div class="item">
        <input type="checkbox" @change="updateCheck()" v-model="item.completed"/>
        <span :class="[item.completed ? 'completed' : '', itemTest]">{{item.name}}</span>
        <button @click="removeItem()" class="trashcan"><font-awesome-icon icon="trash"/></button>
    </div>
</template>

<script>
export default {
    name: "list-item",
    props: ['item'],
    methods: {
      updateCheck() {
        this.axios.put('api/items/' + this.item.id, {
            item: this.item
        }).then(response => {
            if(response.data.status === 200){
                this.$emit('itemchanged');
            }
        })
          .catch(error => {
              console.log(error);
          })
      },
        removeItem() {
          this.axios.delete('api/item/' + this.item.id).then(
              response => {
                  if(response.data.status === 200){
                      this.$emit('itemChanged');
                  }
              })
            .catch(error => {
                console.log(error)
            })
        }
    },
}
</script>

<style scoped>

</style>
