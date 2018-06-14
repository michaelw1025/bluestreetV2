<?php

use Illuminate\Database\Seeder;
use App\CostCenter;

class CostCentersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $cc1 = new CostCenter();
        $cc1->number = 2000;
        $cc1->description = 'administration';
        $cc1->save();

        $cc2 = new CostCenter();
        $cc2->number = 1000;
        $cc2->description = 'manufacturing period expenses';
        $cc2->save();

        $cc3 = new CostCenter();
        $cc3->number = 2001;
        $cc3->description = 'finance';
        $cc3->save();

        $cc4 = new CostCenter();
        $cc4->number = 2003;
        $cc4->description = 'information systems';
        $cc4->save();

        $cc5 = new CostCenter();
        $cc5->number = 2006;
        $cc5->description = 'material control';
        $cc5->save();

        $cc6 = new CostCenter();
        $cc6->number = 2009;
        $cc6->description = 'quality assurance';
        $cc6->save();

        $cc7 = new CostCenter();
        $cc7->number = 2004;
        $cc7->description = 'human resources';
        $cc7->save();

        $cc8 = new CostCenter();
        $cc8->number = 2010;
        $cc8->description = 'manufacturing services';
        $cc8->save();

        $cc9 = new CostCenter();
        $cc9->number = 2011;
        $cc9->description = 'fixed assembly';
        $cc9->save();

        $cc10 = new CostCenter();
        $cc10->number = 2015;
        $cc10->description = 'continuous improvement';
        $cc10->save();

        $cc11 = new CostCenter();
        $cc11->number = 2013;
        $cc11->description = 'facilities maintenance';
        $cc11->save();

        $cc12 = new CostCenter();
        $cc12->number = 2014;
        $cc12->description = 'training';
        $cc12->save();

        $cc13 = new CostCenter();
        $cc13->number = 3020;
        $cc13->description = 'tool crib';
        $cc13->save();

        $cc14 = new CostCenter();
        $cc14->number = 3100;
        $cc14->description = 'general machining';
        $cc14->save();

        $cc15 = new CostCenter();
        $cc15->number = 3106;
        $cc15->description = 'main bearing';
        $cc15->save();

        $cc16 = new CostCenter();
        $cc16->number = 3200;
        $cc16->description = 'general scroll machining';
        $cc16->save();

        $cc17 = new CostCenter();
        $cc17->number = 3287;
        $cc17->description = 'scroll maintenance';
        $cc17->save();

        $cc18 = new CostCenter();
        $cc18->number = 3281;
        $cc18->description = 'tool setting';
        $cc18->save();

        $cc19 = new CostCenter();
        $cc19->number = 3201;
        $cc19->description = 'scroll cell 1';
        $cc19->save();

        $cc20 = new CostCenter();
        $cc20->number = 3202;
        $cc20->description = 'scroll cell 2';
        $cc20->save();

        $cc21 = new CostCenter();
        $cc21->number = 3203;
        $cc21->description = 'scroll cell 3';
        $cc21->save();

        $cc22 = new CostCenter();
        $cc22->number = 3204;
        $cc22->description = 'scroll cell 4';
        $cc22->save();

        $cc23 = new CostCenter();
        $cc23->number = 3205;
        $cc23->description = 'scroll cell 5';
        $cc23->save();

        $cc24 = new CostCenter();
        $cc24->number = 3206;
        $cc24->description = 'scroll cell 6';
        $cc24->save();

        $cc25 = new CostCenter();
        $cc25->number = 3207;
        $cc25->description = 'scroll cell 7';
        $cc25->save();

        $cc26 = new CostCenter();
        $cc26->number = 3208;
        $cc26->description = 'scroll cell 8';
        $cc26->save();

        $cc27 = new CostCenter();
        $cc27->number = 3209;
        $cc27->description = 'scroll cell 9';
        $cc27->save();

        $cc28 = new CostCenter();
        $cc28->number = 3210;
        $cc28->description = 'scroll cell 10';
        $cc28->save();

        $cc29 = new CostCenter();
        $cc29->number = 3010;
        $cc29->description = 'chem team';
        $cc29->save();

        $cc30 = new CostCenter();
        $cc30->number = 3400;
        $cc30->description = 'general assembly';
        $cc30->save();

        $cc31 = new CostCenter();
        $cc31->number = 3401;
        $cc31->description = 'shell fab line 1';
        $cc31->save();

        $cc32 = new CostCenter();
        $cc32->number = 3411;
        $cc32->description = 'assembly line 1';
        $cc32->save();

        $cc33 = new CostCenter();
        $cc33->number = 3301;
        $cc33->description = 'sub-assembly';
        $cc33->save();

        $cc34 = new CostCenter();
        $cc34->number = 3431;
        $cc34->description = 'weld & test line 1';
        $cc34->save();

        $cc35 = new CostCenter();
        $cc35->number = 3402;
        $cc35->description = 'shell fab line 2';
        $cc35->save();

        $cc36 = new CostCenter();
        $cc36->number = 3412;
        $cc36->description = 'assembly line 2';
        $cc36->save();

        $cc37 = new CostCenter();
        $cc37->number = 3432;
        $cc37->description = 'weld & test line 2';
        $cc37->save();

        $cc38 = new CostCenter();
        $cc38->number = 3501;
        $cc38->description = 'paint & dehydration line 1 & 2';
        $cc38->save();

        $cc39 = new CostCenter();
        $cc39->number = 3502;
        $cc39->description = 'final pack line 1 & 2';
        $cc39->save();

        $cc40 = new CostCenter();
        $cc40->number = 3510;
        $cc40->description = 'single pack';
        $cc40->save();

        $cc41 = new CostCenter();
        $cc41->number = 3437;
        $cc41->description = 'assembly maintenance';
        $cc41->save();

        $cc42 = new CostCenter();
        $cc42->number = 3440;
        $cc42->description = 'teardown';
        $cc42->save();

        $cc43 = new CostCenter();
        $cc43->number = 3504;
        $cc43->description = 'paint & dehydration line 4 & 5';
        $cc43->save();

        $cc44 = new CostCenter();
        $cc44->number = 3503;
        $cc44->description = 'final process line 4 & 5';
        $cc44->save();

        $cc45 = new CostCenter();
        $cc45->number = 3404;
        $cc45->description = 'shell fab & kitting line 4';
        $cc45->save();

        $cc46 = new CostCenter();
        $cc46->number = 3414;
        $cc46->description = 'assembly line 4';
        $cc46->save();

        $cc47 = new CostCenter();
        $cc47->number = 3424;
        $cc47->description = 'weld & test line 4';
        $cc47->save();

        $cc48 = new CostCenter();
        $cc48->number = 3405;
        $cc48->description = 'shell fab & kitting line 5';
        $cc48->save();

        $cc49 = new CostCenter();
        $cc49->number = 3415;
        $cc49->description = 'assembly line 5';
        $cc49->save();

        $cc50 = new CostCenter();
        $cc50->number = 3425;
        $cc50->description = 'weld & test line 5';
        $cc50->save();

        $cc51 = new CostCenter();
        $cc51->number = 3417;
        $cc51->description = 'assembly line 7';
        $cc51->save();

        $cc52 = new CostCenter();
        $cc52->number = 3008;
        $cc52->description = 'machine gauging';
        $cc52->save();

        $cc53 = new CostCenter();
        $cc53->number = 3009;
        $cc53->description = 'tool room';
        $cc53->save();

        $cc54 = new CostCenter();
        $cc54->number = 3003;
        $cc54->description = 'material handling';
        $cc54->save();

        $cc55 = new CostCenter();
        $cc55->number = 3001;
        $cc55->description = 'quality assurance 2';
        $cc55->save();

        $cc56 = new CostCenter();
        $cc56->number = 3438;
        $cc56->description = 'quality assurance scroll';
        $cc56->save();

        $cc57 = new CostCenter();
        $cc57->number = 3002;
        $cc57->description = 'rma lab';
        $cc57->save();

        $cc58 = new CostCenter();
        $cc58->number = 3439;
        $cc58->description = 'quality assurance assembly';
        $cc58->save();

        $cc59 = new CostCenter();
        $cc59->number = 3013;
        $cc59->description = 'gauge lab';
        $cc59->save();

        $cc60 = new CostCenter();
        $cc60->number = 3016;
        $cc60->description = 'product assessment';
        $cc60->save();

        $cc61 = new CostCenter();
        $cc61->number = 3018;
        $cc61->description = 'quality tear down';
        $cc61->save();

        $cc62 = new CostCenter();
        $cc62->number = 3000;
        $cc62->description = 'shop operations';
        $cc62->save();

        $cc63 = new CostCenter();
        $cc63->number = 3406;
        $cc63->description = 'vss assembly line 6';
        $cc63->save();

        $cc64 = new CostCenter();
        $cc64->number = 0000;
        $cc64->description = 'corporate';
        $cc64->save();
    }
}
