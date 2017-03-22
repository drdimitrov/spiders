<template>
    <div>
        <div class="form-group fg1">            
            <input type="text" id="family_name" class="form-control" placeholder="Choose Family">
            <input type="hidden" id="family" name="family" :value="family_id">          
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-primary">Search</button>
        </div>
    </div> 
</template>

<script>
    import autocomplete from 'autocomplete.js';
    import algolia from 'algoliasearch';

    export default {
        data(){
            return {
                family_id : null
            }
        },
        methods: {
            //
        },
        mounted() {

            const index = algolia('G437GIPECU', 'ed5ac16faecbf760f179127985d565f1')
                .initIndex('families');

            let selectFamily = autocomplete('#family_name', {
                hint : true
            }, {
                source : autocomplete.sources.hits(index, {
                    hitsPerPage : 50
                }),
                displayKey : 'name',
                templates : {
                    suggestion(suggestion){
                        return `<span>${suggestion._highlightResult.name.value}</span>`;
                    }
                },                
                empty : `<div class="aa-empty">No families found</div>`
            }).on('autocomplete:selected', function(event, suggestion, dataset){
                this.family_id = suggestion.id;
                selectFamily.autocomplete.setVal(suggestion.name); 
            }.bind(this));
        }
    }
</script>
