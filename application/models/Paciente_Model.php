<?php
class Paciente_Model extends CI_Model
{
    public function fetch_all()
    {
       # $this->db->order_by('pk_paciente', 'ASC');
        return $this->db->get('pacientes');
    }

    public function get($user_id)
    {
        $this->db->where('pk_paciente', $user_id);
        $query = $this->db->get('pacientes');
        return $query->result_array();
    }

    public function get_by_email($email)
    {
        $this->db->where('email', $email);
        $query = $this->db->get('pacientes');
        return $query->result_array();
    }


    public function insert($data)
    {
        $this->db->insert('pacientes', $data);
    }

    public function update($user_id, $data)
    {
        $this->db->where('pk_paciente', $user_id);
        $this->db->update('pacientes', $data);
    }

    public function delete($user_id)
    {
        $this->db->where('pk_paciente', $user_id);
        $this->db->delete('pacientes');
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }
}
