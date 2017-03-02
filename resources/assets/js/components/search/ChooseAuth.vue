<template>
    <div>
        <div class="form-group">
            <input type="text" id="author_name" class="form-control" placeholder="Choose Author">
            <input v-for="auth in authors" type="hidden" name="authors[]" :value="auth.id">
        </div>
        <ul class="list-inline">
            
                <span v-for="auth in authors" class="tag label label-info">
                    <span>{{ auth.last_name }} {{ auth.first_name }}</span>
                    <a @click.prevent="removeAuthor(auth)"><i class="remove glyphicon glyphicon-remove-sign glyphicon-white"></i></a> 
                </span>
            
        </ul>
    </div>
</template>

<script>
    import autocomplete from 'autocomplete.js';
    import algolia from 'algoliasearch';

    export default {
        data(){
            return {
                authors : []
            }
        },
        methods: {
            addAuthor(author){
                var existing = this.authors.find((a) => {
                    return a.id == author.id;
                })

                if(existing){
                    return;
                }

                this.authors.push(author);
            },

            removeAuthor(author){
                this.authors = this.authors.filter((a) => {
                    return a.id !== author.id;
                });
            }
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
                this.addAuthor(suggestion);
                selectAuthor.autocomplete.setVal('');                
            }.bind(this));

        }
    }
</script>
