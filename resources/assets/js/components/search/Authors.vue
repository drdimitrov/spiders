<template>
    <form action="/literature" method="GET" class="form-inline">
        <div class="form-group fg1">            
            <input type="text" id="author_name" class="form-control" placeholder="Choose Author">
            <input type="hidden" id="author" name="author" value="">          
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-primary">Search</button>
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

            autocomplete('#author_name', {
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
                $('#author').attr('value', suggestion.id);
            });
        }
    }
</script>
