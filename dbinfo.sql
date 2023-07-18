create database bbs2023;
grant all on bbs2023.* to bbs2023user@localhost identified by 'bbs2023pass';

--

DROP TABLE bbses;
CREATE TABLE bbses (
    bbs_id SERIAL ,
    name VARCHAR(128) NOT NULL COMMENT '投稿者名',
    title VARCHAR(128) NOT NULL COMMENT 'タイトル',
    body TEXT COMMENT '本文',
    -- 
    user_agent TEXT COMMENT 'ブラウザ名',
    from_ip VARBINARY(128) NOT NULL COMMENT '接続元IP',
    -- 
    created_at DATETIME NOT NULL COMMENT '',
    -- updated_at DATETIME NOT NULL COMMENT '',
    -- 
    PRIMARY KEY(bbs_id)
)CHARACTER SET 'utf8mb4', COMMENT='掲示板テーブル';

