/*
@license
dhtmlxScheduler v.5.1.6 Stardard

This software is covered by GPL license. You also can obtain Commercial or Enterprise license to use it in non-GPL project - please contact sales@dhtmlx.com. Usage without proper license is prohibited.

(c) Dinamenta, UAB.
*/
scheduler.date.add_agenda=function(e){return scheduler.date.add(e,1,"year")},scheduler.templates.agenda_time=function(e,t,a){return a._timed?this.day_date(a.start_date,a.end_date,a)+" "+this.event_date(e):scheduler.templates.day_date(e)+" &ndash; "+scheduler.templates.day_date(t)},scheduler.templates.agenda_text=function(e,t,a){return a.text},scheduler.templates.agenda_date=function(){return""},scheduler.date.agenda_start=function(){return scheduler.date.date_part(scheduler._currentDate())},scheduler.attachEvent("onTemplatesReady",function(){
function e(e){if(e){var t=scheduler.locale.labels,a=scheduler._waiAria.agendaHeadAttrString(),i=scheduler._waiAria.agendaHeadDateString(t.date),n=scheduler._waiAria.agendaHeadDescriptionString(t.description);scheduler._els.dhx_cal_header[0].innerHTML="<div "+a+" class='dhx_agenda_line'><div "+i+">"+t.date+"</div><span style='padding-left:25px' "+n+">"+t.description+"</span></div>",scheduler._table_view=!0,scheduler.set_sizes()}}function t(){var e=(scheduler._date,scheduler.get_visible_events());e.sort(function(e,t){
return e.start_date>t.start_date?1:-1});for(var t,a=scheduler._waiAria.agendaDataAttrString(),i="<div class='dhx_agenda_area' "+a+">",n=0;n<e.length;n++){var r=e[n],l=r.color?"background:"+r.color+";":"",o=r.textColor?"color:"+r.textColor+";":"",d=scheduler.templates.event_class(r.start_date,r.end_date,r);t=scheduler._waiAria.agendaEventAttrString(r);var s=scheduler._waiAria.agendaDetailsBtnString();i+="<div "+t+" class='dhx_agenda_line"+(d?" "+d:"")+"' event_id='"+r.id+"' style='"+o+l+(r._text_style||"")+"'><div class='dhx_agenda_event_time'>"+scheduler.templates.agenda_time(r.start_date,r.end_date,r)+"</div>",
i+="<div "+s+" class='dhx_event_icon icon_details'>&nbsp;</div>",i+="<span>"+scheduler.templates.agenda_text(r.start_date,r.end_date,r)+"</span></div>"}i+="<div class='dhx_v_border'></div></div>",scheduler._els.dhx_cal_data[0].innerHTML=i,scheduler._els.dhx_cal_data[0].childNodes[0].scrollTop=scheduler._agendaScrollTop||0;var _=scheduler._els.dhx_cal_data[0].childNodes[0],c=_.childNodes[_.childNodes.length-1];c.style.height=_.offsetHeight<scheduler._els.dhx_cal_data[0].offsetHeight?"100%":_.offsetHeight+"px";
var u=scheduler._els.dhx_cal_data[0].firstChild.childNodes;scheduler._els.dhx_cal_date[0].innerHTML=scheduler.templates.agenda_date(scheduler._min_date,scheduler._max_date,scheduler._mode),scheduler._rendered=[];for(var n=0;n<u.length-1;n++)scheduler._rendered[n]=u[n]}var a=scheduler.dblclick_dhx_cal_data;scheduler.dblclick_dhx_cal_data=function(){if("agenda"==this._mode)!this.config.readonly&&this.config.dblclick_create&&this.addEventNow();else if(a)return a.apply(this,arguments)};var i=scheduler.render_data;
scheduler.render_data=function(e){return"agenda"!=this._mode?i.apply(this,arguments):void t()};var n=scheduler.render_view_data;scheduler.render_view_data=function(){return"agenda"==this._mode&&(scheduler._agendaScrollTop=scheduler._els.dhx_cal_data[0].childNodes[0].scrollTop,scheduler._els.dhx_cal_data[0].childNodes[0].scrollTop=0),n.apply(this,arguments)},scheduler.agenda_view=function(a){scheduler._min_date=scheduler.config.agenda_start||scheduler.date.agenda_start(scheduler._date),scheduler._max_date=scheduler.config.agenda_end||scheduler.date.add_agenda(scheduler._min_date,1),
e(a),a?(scheduler._cols=null,scheduler._colsS=null,scheduler._table_view=!0,t()):scheduler._table_view=!1}});
//# sourceMappingURL=../sources/ext/dhtmlxscheduler_agenda_view.js.map