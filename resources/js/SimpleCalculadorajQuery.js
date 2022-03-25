/*
 * jQuery SimpleCalculadora
 * @author dimti28@gmail.com - http://develoteca.com
 * @version 1.0
 * @date Julio 10, 2015
 * @category jQuery plugin
 * @copyright (c) 2015 dimti28@gmail.com (http://develoteca.com)
 * @license CC Attribution-NonCommercial-ShareAlike 3.0 Unported (CC BY-NC-SA 3.0) - http://creativecommons.org/licenses/by-nc-sa/3.0/
 */
 jQuery.fn.extend({Calculadora: function(op) {
					var LaCalculadora=this;
					var idInstancia=$(LaCalculadora).attr('id');
					var NombreBotonesClase=idInstancia+'tcl';
					var Clase;
    				var Botones;
					var Signos;
					
					defaults = {
						TituloHTML:'<a class="cal_button" id="closef">&#10006;</a>',
						Botones:["1","2","3","+","4","5","6","-","7","8","9","*","0",".","=","/"],
						Signos:["+", "-", "*", "/"],
						ClaseBtns1: 'primary',
						ClaseBtns2: 'success',
						ClaseBtns3: 'warning',
						ClaseColumnas:'col-md-3 col-xs-3 mbottom',
						ClaseBotones:'btn3d btn-lg btn-block btn btn-',
						txtSalida:idInstancia+'txtResultado',
						ClasetxtSalida:'form-control txtr',
						InputBorrar:idInstancia+'Borrar',
						ClaseInputBorrar:'btn3d btn btn-danger btn-lg btn-block',
						EtiquetaBorrar:'Borrar'
					}
					
                    var op = $.extend({}, defaults, op);
					Botones=op.Botones;
					Signos=op.Signos;
                    $(LaCalculadora).append('<input type="text" class="'+op.ClasetxtSalida+' click_id" id="'+op.txtSalida+'" value="" >');
					$(LaCalculadora).append('<div class="row" id="'+idInstancia+'btns"></div>');					$.each(Botones, function(index,value) {	
						Clase=op.ClaseBtns1			
						if(Signos.indexOf(value)>-1){Clase=op.ClaseBtns2;}
						if(value=='='){Clase=op.ClaseBtns3;}
						$('#'+idInstancia+'btns').append('<div class="'+op.ClaseColumnas+'"><input type="button" class="'+NombreBotonesClase+' '+op.ClaseBotones+Clase+'" value="'+value+'"/></div>');
					});
					$(LaCalculadora).append('<div class="row"><div class="col-md-6"><input type="button" id="'+op.InputBorrar+'" class="'+op.ClaseInputBorrar+' ch_clr_color" value="'+op.EtiquetaBorrar+'"></div><div class="col-md-6"><input type="button" id="close" class="btn3d btn btn-info btn-lg btn-block ch_clr_color" value="CLOSE"></div></div>');
					$(LaCalculadora).html('<div class="panel panel-primary btn-block calculadoraBase  mtop">'+op.TituloHTML+'<div class="panel-body"><div class="col-md-12" style="margin-bottom: 10px;">'+$(LaCalculadora).html()+'</div></div> </div>');
					
					$('.'+NombreBotonesClase).click(function(){
						var vTecla=$(this).val();
						var salida=$('#'+op.txtSalida);
						if(vTecla=='='){salida.val(eval(salida.val()));}
						else{if((salida.val()==0)){
							if(Signos.indexOf(vTecla)>-1){salida.val(0)}
							else{salida.val(vTecla);}
						}else{salida.val(salida.val()+vTecla);} 
						}
					});
					$("#"+op.InputBorrar).click(function(){$('#'+op.txtSalida).val("0");});	
						 $(document).on('click', '#close,#closef', function() { $('#calculator').modal('hide'); 
    });
	}
});