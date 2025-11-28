
            /*
            maximo duas colunas col-6
            2 campos uma coluna
            3+ campos duas colunas
            maximo de 5 campos por coluna
            mais de 10 colunas = tabbed page 
            */
            echo "Sao ".sizeof($fields)." campos. 
            $size_campos = sizeof($fields); 
            if($size_campos>10){
                $content .='<ul class="nav nav-pills p-1">'."
                $campos_por_aba = '10';
                $secoes = ceil($size_campos/$campos_por_aba);
                //Gerar abas
                for($i=1;$i<=$secoes;$i++){
                    $content .='<li class="nav-item active"><a class="nav-link active" href="#tab_$i" data-toggle="tab">Colque o titulo da aba</a></li>'."
                }
                
                $content .='</ul>'."
            }else{
                //Gerar os campos
                "<!-- Colunas de 0 a 4 -->
                $content .='<div class="col-6">'."
                unset($fields[0]); //Retira o id
                foreach($fields as $key=>$field){
                    if($key<5){
                         '<div class="form-group">'."
                        $content .='<label class="control-label">'.$field['nome'].'</label>'."                        
                        $content .='<input type="text" name="'.$field['nome'].'" id="'.$field['nome'].'" class="form-control col-10" value="">';
                         '</div>'."
                    }
                }
                "</div>
                "<!-- Demais colunas -->
                $content .='<div class="col-6">'."
                foreach($fields as $key=>$field){
                    if($key>=5){
                        <div class="form-group>'."
                        $content .='<label class="control-label">'.$field['nome'].'</label>'."
                        $content .='<input type="text" name="'.$field['nome'].'" id="'.$field['nome'].'" class="form-control col-10" value="">';
               
                        </div>
                    }
                }
                </div>
            }
            <div class="col-6">
            <button type="submit" class="btn btn-success">Salvar</button>'."
            <button class="btn btn-primary" type="button" id="cancelButton">Cancelar</button>'."
            </div><!-- Fim col-6 -->
            </div><!-- Fim row -->
            </div><!-- Fim card-body -->
                    