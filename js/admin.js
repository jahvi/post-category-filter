(function ( $ ) {

    'use strict';

    $(function () {

        var filterField = '<input type="search" class="fc-search-field" placeholder="' + fc_plugin.placeholder + '" style="width: 100%" />',
            $categoryDivs;

        // Position filter box depending on admin screen
        if (fc_plugin.screenName === 'edit') {

            $categoryDivs = $('.inline-edit-categories .inline-edit-col');
            $categoryDivs
                .find('.cat-checklist')
                .before(filterField);

        } else {

            $categoryDivs = $('.categorydiv');
            $categoryDivs
                .prepend(filterField);

        }

        $categoryDivs.on('keyup search', '.fc-search-field', function (event) {

            var searchTerm = event.target.value,
                $listItems;

            // Find category list items depending on admin screen
            if (fc_plugin.screenName === 'edit') {

                $listItems = $(this).next('.cat-checklist').find('li');

            } else {

                $listItems = $(this).parent().find('.categorychecklist li');

            }

            if ($.trim(searchTerm)) {

                $listItems.hide().filter(function () {
                    return $(this).text().toLowerCase().indexOf(searchTerm.toLowerCase()) !== -1;
                }).show();

            } else {

                $listItems.show();

            }

        });

    });

}(jQuery));