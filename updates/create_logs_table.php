<?php

namespace Renatio\MailLog\Updates;

use October\Rain\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;
use Schema;

class CreateLogsTable extends Migration
{
    public function up()
    {
        Schema::create('renatio_maillog_logs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('to')->nullable();
            $table->string('from')->nullable();
            $table->string('subject')->nullable();
            $table->string('template')->nullable();
            $table->string('cc')->nullable();
            $table->string('bcc')->nullable();
            $table->longText('content_html')->nullable();
            $table->longText('attachments')->nullable();
            $table->string('ip_address')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('renatio_maillog_logs');
    }
}
