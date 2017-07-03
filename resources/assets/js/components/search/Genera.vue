<template>    
    <div class="form-group fg1">            
        <input type="text" id="genus_name" class="form-control" placeholder="Choose Genus">
        <input type="hidden" id="genus" name="genus_id" :value="genus_id">          
    </div>        
</template>

<script>
    import autocomplete from 'autocomplete.js';
    import algolia from 'algoliasearch';

    export default {
        data(){
            return {
                genus_id : null
            }
        },
        methods: {
            //
        },
        mounted() {

            const index = algolia('G437GIPECU', 'ed5ac16faecbf760f179127985d565f1')
                .initIndex('genera');

            let selectGenus = autocomplete('#genus_name', {
                hint : true,
                minLength : 2
            }, {
                source : autocomplete.sources.hits(index, {
                    hitsPerPage : 50,
                }),
                displayKey : 'name',
                templates : {
                    suggestion(suggestion){
                        return `<span>${suggestion._highlightResult.name.value} </span>`;
                    }
                },                
                empty : `<div class="aa-empty">No authors found</div>`
            }).on('autocomplete:selected', function(event, suggestion, dataset){
                this.genus_id = suggestion.id;
                selectGenus.autocomplete.setVal(suggestion.name);   
            }.bind(this));
        }
    }
</script>
