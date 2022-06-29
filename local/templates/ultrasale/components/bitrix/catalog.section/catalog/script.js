/**
 * Created by Sergey Akulov (sergey.a.akulov@gmail.com) on 29.11.2021.
 */

$(document).ready(function(){
    let newUrl = window.location.href;
    $('.selectric-wrapper select').on('change',function(e){
        newUrl = updateURLParameter(window.location.href, 'amount', $(this).val());
        window.location.href = newUrl;
    });
});


function updateURLParameter(url, param, paramVal)
{
    let TheParams;
    let tmpAnchor;
    let TheAnchor = null;
    let newAdditionalURL = "";
    let tempArray = url.split("?");
    let baseURL = tempArray[0];
    let additionalURL = tempArray[1];
    let temp = "";

    if (additionalURL)
    {
        tmpAnchor = additionalURL.split("#");
        TheParams = tmpAnchor[0];
        TheAnchor = tmpAnchor[1];
        if(TheAnchor)
            additionalURL = TheParams;

        tempArray = additionalURL.split("&");

        for (var i=0; i<tempArray.length; i++)
        {
            if(tempArray[i].split('=')[0] != param)
            {
                newAdditionalURL += temp + tempArray[i];
                temp = "&";
            }
        }
    }
    else
    {
        tmpAnchor = baseURL.split("#");
        TheParams = tmpAnchor[0];
        TheAnchor  = tmpAnchor[1];

        if(TheParams)
            baseURL = TheParams;
    }

    if(TheAnchor)
        paramVal += "#" + TheAnchor;

    let rows_txt = temp + "" + param + "=" + paramVal;
    return baseURL + "?" + newAdditionalURL + rows_txt;
}