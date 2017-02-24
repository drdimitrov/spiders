<template>
    <form action="#" @submit.prevent="show" class="form-inline">
        <div class="form-group fg1">
            <label for="authors">Choose Author</label>            
            <input type="text" name="authors" id="authors" class="form-control">          
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-primary">Search</button>
        </div>
    </form>
    bla
</template>

<script>
    export default {
        methods: {
            show(){
                console.log('test');
            }
        },
        mounted() {
            //
        }
    }
</script>
