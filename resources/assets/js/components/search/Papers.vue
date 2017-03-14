<template>
    <div>        
        <div class="form-group">
            <input type="text" id="year_published" v-model="year_published" class="form-control" placeholder="Year">            
        </div>
        <div class="form-group">
            <input type="text" id="author_name" class="form-control" placeholder="Choose Author">            
        </div>
        &nbsp;&nbsp;
        <div class="form-group">
            <label for="sel1">Select paper:</label>            
            <select class="form-control" id="sel1">
                <option>Tragnal kos s dalag nos, prez gorata gol i bos</option>
                <option v-for="paper in papers">{{paper.name}}</option>
            </select>
        </div>
    </div>
</template>

<script>
    import autocomplete from 'autocomplete.js';
    import algolia from 'algoliasearch';

    export default {
        data(){
            return {
                author : null,
                year_published : null,
                papers : []
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
                this.author == suggestion.id;
                //console.log(this.author, this.year_published);
                //selectAuthor.autocomplete.setVal('');

                $.post('/algolia/search-papers', {
                    author : suggestion.id,
                    year : this.year_published,
                    _token: 'SjME8e76Q7mlPfEmByZAoBHsjikso17RIBCgMiPW'
                }, (data) => {
                    console.log(data);
                });                
            }.bind(this));

        }
    }
</script>
