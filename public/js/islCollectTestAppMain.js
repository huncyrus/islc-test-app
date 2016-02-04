$(document).ready(function() {
    var columnOne = [
            {'User name': 'user_name'},
            {'Email address': 'email_address'},
            {'Last login time': 'last_login'},
            {'Number of created document': 'number_of_created_docs'},
            {'Download of documents': 'downloaded_doc_num'}
        ],
        columnTwo = [
            {'User name': 'user_name'},
            {'Year': 'target_year'},
            {'Month': 'target_month'},
            {'Download number': 'counted'}
        ],
        columnThree = [
            {'Downloads': 'downloads'},
            {'Document Title': 'title'},
            {'User name': 'user_name'}
        ],
        columns = {
            'one': columnOne,
            'two': columnTwo,
            'three': columnThree
        };

    $('.q1').on('click', function (e) {
        e.preventDefault();
        getData('backend/index.php?getFirst', columns.one);
        menuButtonFixer($(this));
    });
    $('.q2').on('click', function (e) {
        e.preventDefault();
        getData('backend/index.php?getSecond', columns.two);
        menuButtonFixer($(this));
    });
    $('.q3').on('click', function (e) {
        e.preventDefault();
        getData('backend/index.php?getThird', columns.three);
        menuButtonFixer($(this));
    });


    /**
     * Active/Normal menu element util for bootstrap standard navigation
     * @param me this hoax
     */
    function menuButtonFixer(me) {
        $('ul.nav li').removeClass('active');
        $(me).parent('li').addClass('active');
    }


    /**
     * Simple ajax get request with small error handling
     * @param url string
     * @param columns array obj with column header details
     */
    function getData(url, columns) {
        var result = null;

        if (url) {
            $.get(url)
                .done(function (data) {
                    $('.status').html(tableBuilder(data, columns));
                    extraAddon($('.status').html());
                })
                .fail(function () {
                    result = 'Error #1';
                }).complete ( function (response) {
                    result = response;
                    console.info('ajax call completed...');
            });
        } else {
            result = 'Error';
        }
    }


    /**
     * Table structure builder async helper
     * @param data json string
     * @param columns obj array with column names
     * @returns {string}
     */
    function tableBuilder(data, columns) {
        var table = '<table class="table table-striped table-hover table-responsive">',
            encodedData = $.parseJSON(data);

        if ('' != encodedData.error) {
            table = '<p class="error">Error @ retrieving data...</p>';
        } else {
            table += buildColumns(columns);
            table += buildTableBody(encodedData.data, columns);
            table += '</table>';
        }

        return table;
    }


    /**
     * Table head section (<thead>) builder
     * @param columns array
     */
    function buildColumns(columns) {
        if (columns) {
            var htmlStruct = '<thead><tr>';
            $.each(columns, function (index, value) {
                htmlStruct += '<th>' + Object.keys(value)[0] + '</th>';
            });

            htmlStruct += '</tr></thead>';

            return htmlStruct;
        } else {
            console.error('Table Header builder error. Missing column data... ');
        }
    }

    /**
     * Table <tbody> builder for fill up the table with details
     * @param data array
     * @param columns array
     */
    function buildTableBody(data, columns) {
        var htmlStruct = '<tbody>';
        $.each(data, function (key, val) {
            htmlStruct += '<tr>';
            $.each(columns, function (columnKey, columnValue) {
                $.each(columnValue, function (innerColumnIndex, innerColumnValue) {
                    htmlStruct += '<td>' + val[innerColumnValue] + '</td>';
                });
            });
            htmlStruct += '</tr>';
        });

        htmlStruct += '</tbody>';

        return htmlStruct;
    }


    // sort + filter + utils
    function comparer(index) {
        return function(a, b) {
            var valA = getCellValue(a, index),
                valB = getCellValue(b, index);

            return $.isNumeric(valA) && $.isNumeric(valB) ? valA - valB : valA.localeCompare(valB)
        }
    }


    function getCellValue(row, index) {
        return $(row).children('td').eq(index).html()
    }

    /**
     * Sort + Filter addon for tables
     * @param source DOM
     */
    function extraAddon(source) {
        // sort
        $('th').click(function () {
            var table = $(this).parents('table').eq(0),
                rows = table.find("tr:not(:has('th'))").toArray().sort(comparer($(this).index()));

            this.asc = !this.asc;

            if (!this.asc) {
                rows = rows.reverse();
            }

            for (var i = 0; i < rows.length; i++) {
                table.append(rows[i]);
            }
        });

        // filter
        $('table').each(function () {
            var table = $(this),
                headers = table.find('th').length,
                filterRow = $('<tr>').insertAfter($(this).find('th:last()').parent());

            for (var i = 0; i < headers; i++) {
                filterRow.append($('<th>').append($('<input>').attr('type', 'text').keyup(function () {
                    table.find('tr').show();
                    filterRow.find('input[type=text]').each(function () {

                        var index = $(this).parent().index() + 1,
                            filter = $(this).val() != '';

                        $(this).toggleClass('filtered', filter);

                        if (filter) {
                            var el = 'td:nth-child(' + index + ')',
                                criteria = ":contains('" + $(this).val() + "')";

                            table.find(el + ':not(' + criteria + ')').parent().hide()
                        }
                    });
                })));
            }

            filterRow.append($('<th>').append($('<input>').attr('type', 'button').val('Clear Filter').click(function () {
                $(this).parent().parent().find('input[type=text]').val('').toggleClass('filtered', false);
                table.find('tr').show()
            })));
        });
    }
});
