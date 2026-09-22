<?php
class Thumbnail_model extends CI_Model
{
    private $table = 'your_table_name_here';

    public function get_by_user_and_business($user_id, $business_id)
    {
        return $this->db->get_where($this->table, [
            'user_id' => $user_id,
            'business_id' => $business_id
        ])->row();
    }

    public function insert($data)
    {
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }

    public function update_chat_data($id, $chat_data)
    {
        $this->db->where('id', $id)->update($this->table, ['chat_data' => $chat_data]);
    }

    public function get_by_id($id)
    {
        return $this->db->get_where($this->table, ['id' => $id])->row();
    }
}
