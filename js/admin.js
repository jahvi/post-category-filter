(function ( $ ) {

    'use strict';

    $(function () {

        var filterField = '<input type="search" class="fc-search-field" placeholder="' + fc_plugin.placeholder + '" style="width: 100%" />',
            replacedField,
            $categoryDivs,
            $categoryDiv,
            $inlineChecklists;

        // Position filter box depending on admin screen
        if (fc_plugin.screenName === 'edit') {

            $categoryDivs = $('.inline-edit-categories');
            $inlineChecklists = $categoryDivs.find('.cat-checklist');

            $inlineChecklists.each(function (index, categoryDiv) {
                $categoryDiv = $(categoryDiv);

                // Replace placeholder with correct taxonomy name
                replacedField = filterField.replace(
                    '%s',
                    $categoryDiv.parent().find('.title').eq(index).text()
                );

                $categoryDiv.before(replacedField);
            });

        } else {

            $categoryDivs = $('.categorydiv');

            $categoryDivs.each(function (index, categoryDiv) {
                $categoryDiv = $(categoryDiv);

                // Replace placeholder with correct taxonomy name
                replacedField = filterField.replace(
                    '%s',
                    $categoryDiv.closest('.postbox').find('.hndle').text()
                );

                $categoryDiv.prepend(replacedField);
            });

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