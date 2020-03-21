<?php
class Paciente_Model extends CI_Model
{
    public function fetch_all()
    {
       # $this->db->order_by('pk_paciente', 'ASC');
        return $this->db->get('paciente');
    }

    public function get($user_id)
    {
        $this->db->where('pk_paciente', $user_id);
        $query = $this->db->get('paciente');
        return $query->result_array();
    }

    public function get_by_cpf($cpf)
    {
        $this->db->where('cpf', $cpf);
        $query = $this->db->get('paciente');
        
        if ($query->result(get_called_class())) {
            return $query->result(get_called_class())[0];
        }
        return null;
    }


    public function insert($data)
    {
        $this->db->insert('paciente', $data);
    }

    public function update($user_id, $data)
    {
        $this->db->where('pk_paciente', $user_id);
        $this->db->update('paciente', $data);
    }

    public function delete($user_id)
    {
        $this->db->where('pk_paciente', $user_id);
        $this->db->delete('paciente');
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }
}
