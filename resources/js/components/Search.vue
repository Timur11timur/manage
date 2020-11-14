<template>
    <ais-instant-search :search-client="searchClient" :initial-ui-state="initialUiState" index-name="threads">
        <ais-search-box placeholder="Find a thread" :autofocus="true" />

        <div class="card my-3">
            <div class="card-body pb-0 pt-2 px-2">
                <ais-refinement-list attribute="channel.name" />
            </div>
        </div>

        <ais-hits>
            <div slot="item" slot-scope="{ item }">
                <h2>
                    <a :href="item.path">
                        <ais-highlight attribute="title" :hit="item"/>
                    </a>
                </h2>
            </div>
        </ais-hits>
    </ais-instant-search>
</template>

<script>
import algoliasearch from 'algoliasearch/lite';
import 'instantsearch.css/themes/algolia-min.css';

export default {
    props: ['appid', 'apikey', 'query'],

    data() {
        return {
            searchClient: algoliasearch(
                this.appid,
                this.apikey
            ),
            initialUiState: {
                threads: {
                    query: this.query,
                },
            },
        };
    },
};
</script>

<style>
    ul li {
        display: inline-block;
    }

    ul li label{
        margin-right: 0.75rem;
    }
</style>
