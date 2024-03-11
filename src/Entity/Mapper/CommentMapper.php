<?php

namespace App\Entity\Mapper;

use App\Entity\Comment;
use App\Entity\Dto\CommentDtos\CommentDto;

class CommentMapper {

    public function toEntity(CommentDto $commentDto) : Comment {

        $comment = new Comment();
        $comment->setText($commentDto->getText());

        return $comment;
    }

    public function toDto(Comment $comment) : CommentDto {

        $commentDto = new CommentDto();
        $commentDto->setText($comment->getText());

        return $commentDto;
    }
}