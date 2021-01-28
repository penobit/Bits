<?php

class PostModel extends DataEntry{
    public function __construct($id = null, string $column = 'id'){
        if(isset($id)){
            $this->select($id, $column);
        }
    }

    /**
     * Select post from database
     * 
     * @param int|string $uniqid Post id if $column is not set, otherwise $column value
     * @param string $column post select by specific column
     */
    public function select($uniqid = null, $column = 'id'){
        if(empty($uniqid)) return false;
        $post = iDB::table('posts')->find($uniqid, $column);
        if(isset($post)){
            $this->markAsAvailable();
            $metas = iDB::table('meta')->where('meta_type', 'post')->where('meta_target_id', $post->id);
            $postMeta = [];

            foreach($post as $key => $value)
                $this->set($key, $value);
            foreach($metas->get() as $meta)
                $postMeta[$meta->meta_name] = $meta->meta_value;
            
            $this->set('meta', $postMeta);
        }

        return $this;
    }

    /**
     * Get Post's title
     */
    public function getTitle(){
        return $this->get('post_title');
    }

    /**
     * Set Post's title
     * 
     * @param string $title new title
     */
    public function setTitle(string $title){
        $this->set('post_title', $title);
        return $this;
    }

    /**
     * Get Post's author ID
     */
    public function getAuthor(){
        return $this->get('post_author');
    }

    /**
     * set Post's author
     * 
     * @param int $authorID author's user ID
     */
    public function setAuthor(int $authorID){
        $this->set('post_author', $authorID);
        return $this;
    }

    /**
     * Get Post's content
     */
    public function getContent(){
        return $this->get('post_content');
    }

    /**
     * Set Post's title
     * 
     * @param string $content post content
     */
    public function setContent(string $content){
        $this->set('post_content', $content);
        return $this;
    }

    /**
     * Get Post's publish date
     */
    public function getDate(){
        return $this->get('post_date');
    }

    /**
     * Set Post's title
     * 
     * @param string $date post publishing date
     */
    public function setDate(string $date){
        $this->set('post_date', $date);
        return $this;
    }

    /**
     * Get Post's GUID
     */
    public function getGUID(){
        return $this->get('post_guid');
    }

    /**
     * Set Post's GUID
     * 
     * @param string $guid GUID
     */
    public function setGUID(string $guid){
        $this->set('post_guid', $guid);
        return $this;
    }

    /**
     * Get Post's status
     */
    public function getStatus(){
        return $this->get('post_status');
    }

    /**
     * Set Post's title
     * 
     * @param string $status post status
     */
    public function setStatus(string $status){
        $this->set('post_status', $status);
        return $this;
    }

    /**
     * Get Post's post type
     */
    public function getType(){
        return $this->get('post_type');
    }

    /**
     * set Post's post type
     * 
     * @param string $type post type
     */
    public function setType(string $type){
        $this->set('post_type', $type);
        return $this;
    }

    /**
     * Get Post's photo url
     */
    public function getPhoto(){
        return $this->get('post_photo');
    }

    /**
     * Set Post's photo url
     * 
     * @param string $photoURL url to photo
     */
    public function setPhoto(string $photoURL){
        $this->set('post_photo', $photoURL);
        return $this;
    }

    /**
     * Get Post's modification datetime
     */
    public function getModified(){
        return $this->get('post_modified');
    }

    /**
     * Set Post's modification datetime
     * 
     * @param string $modificationDateTime a date time string, if not set current date time will be set
     */
    public function setModified(string $modificationDateTime = ''){
        if(empty($modificationDateTime)) $modificationDateTime = date('Y-m-d H:i:s');

        
        $this->set('post_modified', $modificationDateTime);
        return $this;
    }

    /**
     * Get Post's excerpt
     */
    public function getExcerpt(){
        return $this->get('post_excerpt');
    }

    /**
     * set Post's title
     * 
     * @param string $excerpt post excerpt
     */
    public function setExcerpt(string $excerpt){
        $this->set('post_excerpt', $excerpt);
        return $this;
    }

    /**
     * Get Post's mimetype
     */
    public function getMimetype(){
        return $this->get('post_mimetype');
    }

    /**
     * Set Post's title
     * 
     * @param string $mimetype post mime type like text/html, image/png, application/json, etc
     */
    public function setMimetype(string $mimetype){
        $this->set('post_mimetype', $mimetype);
        return $this;
    }

    /**
     * Get Post's comments count
     */
    public function getCommentsCount(){
        return $this->get('comments_count');
    }

    /**
     * set Post's comments count
     * 
     * @param int|string $commentsCount 
     */
    public function setCommentsCount($commentsCount){
        if(!is_numeric($commentsCount) && !ctype_digit($commentsCount)){
            return false;
        }
        
        $this->set('comments_count', $commentsCount);
        return $this;
    }
    
    /**
     * Get Post's unique ID
     */
    public function getID(){
        return $this->get('id');
    }
    
    /**
     * Get Post's unique ID
     * 
     * @param int|string $id unique ID
     */
    public function setID($id){
        if(!is_numeric($id) && !ctype_digit($id)){
            return false;
        }

        $this->set('id', $id);
        return $this;
    }

    /**
     * Get Post's meta
     * 
     * @param string $metaName if set returns specified meta otherwise returns all metas array
     */
    public function getMeta(string $metaName = ''){
        $meta = $this->get('meta');
        if(empty($metaName))
            return $meta;

        return $meta[$metaName] ?? null;
    }

    /**
     * set Post's meta
     * 
     * @param string $name meta name
     * @param mixed $value meta value
     */
    public function setMeta(string $name, $value = null){
        if(empty($name) || empty($value)){
            return false;
        }

        $meta = $this->getMeta();
        $meta[$name] = $value;
        
        return $this;
    }

    /**
     * Save Post
     * if isAvailable() update otherwise insert
     */
    public function save(){
        if($this->isAvailable()){
            $this->update();
        }else{
            $this->insert();
        }
    }

    /**
     * updates post in databse
     */
    public function update(){
        if(!$this->isAvailable()){
            return false;
        }

        $data = [
            'post_title' => $this->getTitle(),
            'post_content' => $this->getContent(),
            'post_date' => $this->getDate(),
            'post_author' => $this->getAuthor(),
            'post_guid' => $this->getGUID(),
            'post_type' => $this->getType(),
            'post_mimetype' => $this->getMimetype(),
            'comments_count' => $this->getCommentsCount(),
            'post_excerpt' => $this->getExcerpt(),
            'post_modified' => date('Y-m-d H:i:s'),
            'post_photo' => $this->getPhoto(),
            'post_status' => $this->getStatus(),
        ];

        $this->extendDefaults();
        iDB::table('posts')->where('id', $this->getID())->update($data);

        foreach($this->getMeta() as $name => $value){
            $metaQuery = iDB::table('meta')->where('type', 'post')->where('meta_target_id', $this->getID())->where('meta_name', $name);
            if($metaQuery->count() > 0){
                $metaQuery->update(['meta_value' => $value]);
            }else{
                iDB::table('meta')->insert([
                    'meta_type' => 'post',
                    'meta_target_id' => $this->getID(),
                    'meta_name' => $name,
                    'meta_value' => $value
                ]);
            }
        }
        
        return $this;
    }

    /**
     * insert post as new row in posts table in database 
     */
    public function insert(){
        if($this->isAvailable()){
            return false;
        }

        $data = [
            'post_title' => $this->getTitle(),
            'post_content' => $this->getContent(),
            'post_date' => $this->getDate(),
            'post_author' => $this->getAuthor(),
            'post_guid' => $this->getGUID(),
            'post_type' => $this->getType(),
            'post_mimetype' => $this->getMimetype(),
            'comments_count' => $this->getCommentsCount(),
            'post_excerpt' => $this->getExcerpt(),
            'post_modified' => date('Y-m-d H:i:s'),
            'post_photo' => $this->getPhoto(),
            'post_status' => $this->getStatus(),
        ];

        $this->extendDefaults();
        $id = iDB::table('posts')->insert($data);
        $this->setID($id);
        $this->markAsAvailable();
        
        foreach($this->getMeta() as $name => $value)
            iDB::table('meta')->insert([
                'meta_type' => 'post',
                'meta_target_id' => $this->getID(),
                'meta_name' => $name,
                'meta_value' => $value
            ]);

        return $this;
    }

    /**
     * Delete post from posts table in database
     */
    public function delete(){
        if(!$this->isAvailable()){
            return $this;
        }

        iDB::table('posts')->where('id', $this->getID())->delete();
        $this->markAsNotAvailable();

        return $this;
    }

}