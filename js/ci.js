/*
 * CI公共包
 */
var  CI =  {};
/*
 * src 	共用函数库 
 * run	执行函数
 */
CI.src =  {};

CI.run	=  {};

/**
 * 学习更多
 */
CI.run.LEARN_MODE = function()
{
	
}


/*CHART*/
CI.run.CHART = function (url ,data)
{		
	$.ajax(
	{
        	type: "POST",
        	url : url,
        	dataType:'json',
			data:data,
            success: function(msg) 
			{
                if (msg.retCode == 'S')
				{
					$('#select-chart-rst').html(msg.retMsg);	
				}
                else
                    window.alert(msg.retMsg);
            }
    });   	
}

/**
 * 分页
 * @param string url
 * @param array data (参数中包含页码)
 */
CI.run.PAGE = function (url,data)
{		
	$.ajax(
	{
        	type: "POST",
        	url : url,
        	dataType:'json',
			data:data,
            success: function(msg) 
			{
                if (msg.retCode == 'S')
				{
					/*HTML 渲染生成*/
					$('#div-table-rst').html(msg.retMsg);	
				}
                else
                    window.alert(msg.retMsg);
            }
    }); 	
}

/**
 * Email接口
 * @param {String} url
 * @param {Object} data
 */
CI.run.EMAIL = function (url,data)
{		
	$.ajax(
	{
        	type: "POST",
        	url : url,
        	dataType:'json',
			data:data,
            success: function(msg) 
			{
                if (msg.retCode == 'S')
                    window.location.reload(true);
                else
                    window.alert(msg.retMsg);
            }
    });  	
}

/**
 * Format接口
 * @param {String} url
 * @param {Object} data
 */
CI.run.FORMAT = function (url,data)
{		
	$.ajax(
	{
        	type: "POST",
        	url : url,
        	dataType:'html',
			data:data,
            success: function(msg) 
			{
                $('#run-format-response').val(msg);
            }
    });  	
}

CI.run.API = function (url,data)
{		
	$.ajax(
	{
        	type: "GET",
        	url : url,
        	dataType:'json',
			data:data,
            success: function(msg) 
			{
				$('#run-format-api-param').val(msg.param);
                $('#run-format-api-response').val(msg.response);
				$('#run-format-api-code').html(msg.code);
            }
    });
}
