<?php

class Migration_Create_Tables extends CI_Migration {

    private $tableAdmin;
    private $tableCI_Sessions;
    private $tableEnredos;
    private $tableUsers;
    private $tableVotos;

    public function __construct($config = array()) {
        parent::__construct($config);
        
        $this->tableAdmin = "admin";
        $this->tableCI_Sessions = "ci_sessions";
        $this->tableEnredos = "enredos";
        $this->tableUsers = "users";
        $this->tableVotos = "votos";
    }

    public function up() {
        $attributes = array(
            'ENGINE' => 'InnoDB'
        );

        $this->load->dbforge();
        $adminFields = array(
            'idAdmin' => array(
                'type' => 'INT',
                'unsigned' => True,
                'auto_increment' => True
            ),
            'nomeAdmin' => array(
                'type' => 'VARCHAR',
                'constraint' => '45',
                'null' => False
            ),
            'emailAdmin' => array(
                'type' => 'VARCHAR',
                'constraint' => '45',
                'null' => False
            ),
            'senhaAdmin' => array(
                'type' => 'VARCHAR',
                'constraint' => '45',
                'null' => False
            ),
            'levelAdmin' => array('type' => 'VARCHAR',
                'constraint' => '45',
                'null' => False)
        );
        $this->dbforge->add_field($adminFields);
        $this->dbforge->add_key('idAdmin', TRUE);
        $criou[] = $this->dbforge->create_table($this->tableAdmin, True, $attributes);

        $ci_sessionsFields = array(
            'id' => array(
                'type' => 'VARCHAR',
                'constraint' => '128',
                'auto_increment' => True
            ),
            'ip_address' => array(
                'type' => 'VARCHAR',
                'constraint' => '45',
            ),
            'timestamp' => array(
                'type' => 'INT',
                'constraint' => '10',
                'unsigned' => True,
                'unique' => True
            ),
            'data' => array(
                'type' => 'BLOB'
            )
        );
        $this->dbforge->add_field($ci_sessionsFields);
        $this->dbforge->add_key('id', TRUE);
        $criou[] = $this->dbforge->create_table($this->tableCI_Sessions, True, $attributes);

        $enredosFields = array(
            'idEnredo' => array(
                'type' => 'INT',
                'constraint' => '11',
                'auto_increment' => True
            ),
            'tituloEnredo' => array(
                'type' => 'VARCHAR',
                'constraint' => '255'
            ),
            'enredo' => array(
                'type' => 'text'
            ),
            'imagemIlustrativa' => array(
                'type' => 'VARCHAR',
                'constraint' => '255'
            ),
            'compositor' => array(
                'type' => 'VARCHAR',
                'constraint' => '255'
            ),
            'matricula' => array(
                'type' => 'INT',
                'constraint' => '6'
            ),
            'dataDeNascimento' => array(
                'type' => 'date'
            ),
            'aceite' => array(
                'type' => 'INT',
                'constraint' => '1',
            ),
            'status' => array(
                'type' => 'INT',
                'constraint' => '1',
            ),
            'created_at' => array(
                'type' => 'DATETIME',
            ),
            'updated_at' => array(
                'type' => 'TIMESTAMP',
            ),
        );
        $this->dbforge->add_field($enredosFields);
        $this->dbforge->add_key('idEnredo', TRUE);
        $criou[] = $this->dbforge->create_table($this->tableEnredos, True, $attributes);
        
        $usersFields = array(
            'idUsuario' => array(
                'type' => 'INT',
                'constraint' => '11',
                'auto_increment' => True
            ),
            'matricula' => array(
                'type' => 'INT',
                'constraint' => '6'
            ),
            'nomeCompleto' => array(
                'type' => 'VARCHAR',
                'constraint' => '150'
            ),
            'email' => array(
                'type' => 'VARCHAR',
                'constraint' => '150'
            ),
            'area' => array(
                'type' => 'VARCHAR',
                'constraint' => '45'
            ),
            'cargo' => array(
                'type' => 'VARCHAR',
                'constraint' => '45'
            ),
            'sexo' => array(
                'type' => 'VARCHAR',
                'constraint' => '45'
            ),
            'dataDeNascimento' => array(
                'type' => 'DATE'
            ),
            'cidade' => array(
                'type' => 'VARCHAR',
                'constraint' => '100'
            ),
            'created_at' => array(
                'type' => 'DATETIME',
            ),
            'updated_at' => array(
                'type' => 'TIMESTAMP',
            ),
        );
        $this->dbforge->add_field($usersFields);
        $this->dbforge->add_key('idUsuario', TRUE);
        $criou[] = $this->dbforge->create_table($this->tableUsers, True, $attributes);
        
        $votosFields = array(
            'idVoto' => array(
                'type' => 'INT',
                'constraint' => '11',
                'auto_increment' => True
            ),
            'matricula' => array(
                'type' => 'INT',
                'constraint' => '6'
            ),
            'idEnredo' => array(
                'type' => 'INT',
                'constraint' => '11'
            ),
            'created_at' => array(
                'type' => 'DATETIME',
            ),
            'updated_at' => array(
                'type' => 'TIMESTAMP',
            ),
        );
        $this->dbforge->add_field($votosFields);
        $this->dbforge->add_key('idVoto', TRUE);
        $criou[] = $this->dbforge->create_table($this->tableVotos, True, $attributes);
        var_dump($criou);
    }

    public function down() {
        $this->dbforge->drop_table($this->tableAdmin);
        $this->dbforge->drop_table($this->tableCI_Sessions);
        $this->dbforge->drop_table($this->tableEnredos);
        // $this->dbforge->drop_table('migrations');
        $this->dbforge->drop_table($this->tableUsers);
        $this->dbforge->drop_table($this->tableVotos);
    }

}
