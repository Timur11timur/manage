<template>
    <ais-instant-search :search-client="searchClient" index-name="threads">
        <ais-search-box />

        <ais-refinement-list attribute="channel.name" />

        <ais-hits>
            <div slot="item" slot-scope="{ item }">
                <h2>
                    <a :href="item.path">{{ item.title }}</a>
                </h2>
            </div>
        </ais-hits>
    </ais-instant-search>
</template>

<script>
import algoliasearch from 'algoliasearch/lite';
import 'instantsearch.css/themes/algolia-min.css';

export default {
    props: ['appid', 'apikey'],

    data() {
        return {
            searchClient: algoliasearch(
                this.appid,
                this.apikey
            ),
        };
    },
};
</script>
