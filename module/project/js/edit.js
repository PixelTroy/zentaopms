$(function()
{
    $('#parent').change(function()
    {
        var programID = $(this).val();
        setAclList(programID);

        /* Determine whether the project can change the project set. */
        link = createLink('project', 'ajaxCheckProduct', 'programID=' + programID + '&projectID=' + projectID);
        $.getJSON(link, function(data)
        {
            var changed = true;

            if(data && data.result)
            {
                changed = confirm(data.message);
                if(changed)
                {
                    /* Select change to the new program products. */
                    var lastProductSelect = $('#productsBox .input-group:last select:first');
                    if($(lastProductSelect).val() == 0)
                    {
                        var lastProductSelectID   = $(lastProductSelect).attr("id");
                        var lastProductSelectName = $(lastProductSelect).attr("name");
                        $('#' + lastProductSelectID + '_chosen').remove();
                        $(lastProductSelect).replaceWith(data.newProducts);
                        $('#productsBox .input-group:last select:first').attr('name', lastProductSelectName).attr('id', lastProductSelectID).chosen();
                    }
                }
            }

            if(data && !data.result)
            {
                $('#promptTable tbody tr').remove();
                for(var i in data.message)
                {
                    var product = data.message[i];
                    $('#promptTable').append("<tr><td><i class='icon icon-product'></i> <strong>" + product +"</strong> " + linkedProjectsTip +"</td></tr>");
                    for(var j in data.multiLinkedProjects)
                    {
                        if(i == j)
                        {
                            html = ''
                            for(k in data.multiLinkedProjects[j])
                            {
                                var project = data.multiLinkedProjects[j][k];
                                html += "<p><i class='icon icon-project'></i> " + project +"</p>";
                            }
                            $('#promptTable').append("<tr><td style='padding-left:40px'>" + html + "</td></tr>");
                        }
                    }
                }

                changed = false;
                $('#promptBox').modal({show: true});
            }

            if(!changed) $("#parent").val(oldParent).trigger("chosen:updated");
            oldParent = $('#parent').val();
        });
    });

    adjustProductBoxMargin();
    adjustPlanBoxMargin();

    /* If the story of the product which linked the execution under the project, you don't allow to remove the product. */
    $("#productsBox select").each(function()
    {
        var isExisted = $.inArray($(this).attr('data-last'), unmodifiableProducts);
        if(isExisted != -1)
        {
            $(this).prop('disabled', true).trigger("chosen:updated");
            $(this).siblings('div').find('span').attr('title', tip);
        }
    });

   /* If end is longtime, set the default date to today */
   var today = $.zui.formatDate(new Date(), 'yyyy-MM-dd');
   if($('#end').val() == longTime) $('#end').val(today).datetimepicker('update').val(longTime);
});

/**
 * Set aclList.
 *
 * @param  int   $programID
 * @access public
 * @return void
 */
function setAclList(programID)
{
    if(programID != 0)
    {
        $('.aclBox').html($('#programAcl').html());
    }
    else
    {
        $('.aclBox').html($('#projectAcl').html());
    }
}
