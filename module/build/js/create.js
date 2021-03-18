$().ready(function()
{
    $('#lastBuildBtn').click(function()
    {
        $('#name').val($(this).text()).focus();
    });

});
/**
 * Load products.
 *
 * @param  int $executionID
 * @access public
 * @return void
 */
function loadProducts(executionID)
{
    $('#product').remove();
    $('#product_chosen').remove();
    $('#branch').remove();
    $('#branch_chosen').remove();
    $('#noProduct').remove();
    $.get(createLink('product', 'ajaxGetProducts', 'executionID=' + executionID), function(data)
    {
        if(data)
        {
            if(data.indexOf("required") != -1)
            {
                $('.input-group').addClass('required');
            }
            else
            {
                $('.input-group').removeClass('required');
            }

            $('.input-group').append(data);
            $('#product').chosen();
        }
    });
}
