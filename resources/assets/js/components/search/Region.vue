<template>
    <div>
        <input class="form-control" v-model="search" type="text" >
        <input type="hidden" name="locality_id" v-model="region_id">
        <ul id="selectResults">
                   </ul>
    </div>
</template>

<script>
    import debounce from 'debounce';

    export default{

    }
</script>

<style lang="scss">
    #selectResults{
        display: inline-block;
        margin: 0;
        padding: 0;
        list-style-type: none;
        background: #f2f2f2;
        width: 100%;

        li{
            font-weight: bold;
            margin: 10px;
        }
    }
</style>