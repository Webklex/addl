<?php
class extensionController{
    public function view(){
        $data = Extension::all();

        return $data;
    }

    public function api_load_extensions(){
        $times = Time::all();
        $counter = 0;

        foreach($times as $time){
            $extension_test_project = Extension::find(array('conditions' => array('value = ?', $time->project_name)));
            $extension_test_service = Extension::find(array('conditions' => array('value = ?', $time->service_name)));

            if($extension_test_project == null && $time->project_name != null){
                $create = Extension::create(array('parent' => NULL, 'value' => $time->project_name));
                $counter++;
            }

            if($extension_test_service == null && $time->service_name != null){
                if($extension_test_project == null && $time->project_name != null){
                    $extension_test_project = Extension::find(array('conditions' => array('value = ?', $time->project_name)));
                }
                $create = Extension::create(array('parent' => $extension_test_project->id, 'value' => $time->service_name));
                $counter++;
            }
        }

        echo $counter;
    }

    public function api_view_extensions(){
        $extensions = Extension::all();
        $parents = Extension::all(array('conditions' => array('parent IS NULL')));

        $html = '';

        foreach($extensions as $extension){
            $html .= '<div class="col-lg-10 well col-lg-offset-1 form-group" data-wrapper="extension_body_'.$extension->id.'">
                        <form  data-id="'.$extension->id.'">
                            <div class="row">
                                <div class="col-lg-3 text-left"><b>Elternelement</b></div>
                                <div class="col-lg-9 text-left"><b>Bezeichnung</b></div>
                            </div>
                            <div class="row">
                                <div class="col-lg-3">'.$this->getParentSelector($extension->parent, $parents).'</div>
                                <div class="col-lg-9"><textarea class="form-control" style="resize: none;height: 150px;" name="value">'.$extension->value.'</textarea></div>
                            </div>
                            <div class="row"><div class="col-lg-12"><br /></div></div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <input type="hidden" name="id" value="'.$extension->id.'" />
                                    <button class="btn btn-xs btn-default pull-right delete_extension" data-id="'.$extension->id.'">Löschen</button>
                                    <button class="btn btn-xs btn-default pull-right save_extension" data-id="'.$extension->id.'">Speichern</button>
                                </div>
                            </div>
                        </form>
                      </div>';
        }

        echo $html;
    }

    public function api_delete(){
        $data = true;
        try{
            $save = Extension::find_by_id($_POST['id']);
            $save->delete();
        }catch(Exception $e){
            //ERROR
            $data = false;
        }

        echo (string)$data;
    }

    public function api_save(){
        $data = true;
        $_POST['parent'] = ($_POST['parent']==0?null:$_POST['parent']);
        if($_POST['id'] == 'FIRST'){
            try{
                if(strlen($_POST['value']) > 2){
                    $create = Extension::create(array('parent' => $_POST['parent'], 'value' => $_POST['value']));
                }else{
                    $data = false;
                }
            }catch(Exception $e){
                //ERROR
                $data = false;
            }
        }else{
            try{
                $save = Extension::find_by_id($_POST['id']);
                $save->parent = $_POST['parent'];
                $save->value = $_POST['value'];
                $save->save();
            }catch(Exception $e){
                //ERROR
                $data = false;
            }
        }
        echo (string)$data;
    }

    public function api_add_extension(){
        $parents = Extension::all(array('conditions' => array('parent IS NULL')));

        echo '<div class="col-lg-10 well col-lg-offset-1 form-group">
                <form  data-id="FIRST">
                    <div class="row">
                        <div class="col-lg-3 text-left"><b>Elternelement</b></div>
                        <div class="col-lg-9 text-left"><b>Bezeichnung</b></div>
                    </div>
                    <div class="row">
                        <div class="col-lg-3">'.$this->getParentSelector(null, $parents).'</div>
                        <div class="col-lg-9"><textarea class="form-control" style="resize: none;height: 150px;" name="value"></textarea></div>
                    </div>
                    <div class="row"><div class="col-lg-12"><br /></div></div>
                    <div class="row">
                        <div class="col-lg-12">
                            <input type="hidden" name="id" value="FIRST" />
                            <button class="btn btn-xs btn-default pull-right save_extension" data-id="FIRST">Speichern</button>
                        </div>
                    </div>
                </form>
            </div>';
    }

    private function getParentSelector($chield, $parents){
            $parent_selector = '<select name="parent" class="form-control"><option value="0">-Keine Angaben-</option>';

            foreach($parents as $parent){
                $parent_selector .= '<option value="'.$parent->id.'" '. ($parent->id == $chield?'selected':'').'>'.$parent->value.'</option>';
            }
            $parent_selector .= '</select>';

            return $parent_selector;
    }
}