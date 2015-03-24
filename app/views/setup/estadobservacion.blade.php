<?php $comentario = DB::table('observaciones as ob')->join('observacion_estado AS oe','oe.observacion_id','=','ob.id')->where('oe.estado_empresas_id',$datos->empresas_id)->get(); ?>
 @foreach($comentario AS $coment)
<option value="{{$coment->id}}">{{$coment->name}}</option>
@endforeach                   