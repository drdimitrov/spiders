<template>
    <form method="GET" class="form-inline">
        <div class="form-group fg1">            
            <input type="text" id="author_name" class="form-control" placeholder="Choose Author">
            <input type="hidden" id="author" name="author" :value="author_id">          
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-custom">Search</button>
        </div>
    </form>   
</template>

<script>
    import autocomplete from 'autocomplete.js';
    import algolia from 'algoliasearch';

    export default {
        data(){
            return {
                author_id : null
            }
        },
        methods: {
            //
        },
        mounted() {

            const index = algolia('G437GIPECU', 'ed5ac16faecbf760f179127985d565f1')
                .initIndex('authors');

            let selectAuthor = autocomplete('#author_name', {
                hint : true
            }, {
                source : autocomplete.sources.hits(index, {
                    hitsPerPage : 50
                }),
                displayKey : 'last_name',
                templates : {
                    suggestion(suggestion){
                        return `<span>${suggestion._highlightResult.last_name.value} ${suggestion.first_name}</span>`;
                    }
                },                
                empty : `<div class="aa-empty">No authors found</div>`
            }).on('autocomplete:selected', function(event, suggestion, dataset){
                this.author_id = suggestion.id;
                selectAuthor.autocomplete.setVal(suggestion.first_name + ' ' + suggestion.last_name);   
            }.bind(this));
        }
    }
</script>


