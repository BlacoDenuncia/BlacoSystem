<?php

class Conta_model extends CI_Model {
    public function save_user_photo( $user_id, $photo_path ) {

        $data = array(
            'user_id' => $user_id,
            'photo_path' => $photo_path,
        );
        $this->delete_user_photo( $user_id );

        $this->db->insert( 'user_photos', $data );
        $user_id = $data[ 'user_id' ];

        // Check if the insert operation was successful
        if ( $this->db->affected_rows() > 0 ) {
            return $user_id;
        } else {
            return false;
        }
    }

    public function get_user_photo_url( $user_id ) {
        $this->db->select( 'photo_path' );
        $this->db->where( 'user_id', $user_id );
        $query = $this->db->get( 'user_photos' );

        if ( $query->num_rows() > 0 ) {
            $result = $query->row();
            return $result->photo_path;
        } else {
            return null;
        }

    }

    public function delete_user_photo( $user_id ) {
        $this->db->where( 'user_id', $user_id );
        $this->db->delete( 'user_photos' );
    }

    public function update_user_data( $user_id, $data ) {
        $this->db->where( 'idusuario', $user_id );
        $this->db->update( 'usuarios', $data );
        if ( $this->db->affected_rows() > 0 ) {

            $this->db->where( 'idusuario', $user_id );
            $query = $this->db->get( 'usuarios' );
            $updated_user_data = $query->row_array();
            return $updated_user_data;
        } else {
            return false;
        }
    }
}
?>