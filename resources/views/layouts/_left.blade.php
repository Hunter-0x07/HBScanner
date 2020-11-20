<div class="left-nav">
    <div id="side-nav">
        <ul id="nav">
            <li class="current"><a href="index.html"> <i class="icon-dashboard"></i> 工作台 </a></li>
            <li><a href="#"> <i class="icon-desktop"></i> 端口探测 <i class="arrow icon-angle-left"></i></a>
                <ul class="sub-menu">
                    <li><a href="{{ route('port_task.create') }}"> <i class="icon-angle-right"></i> 新建任务 </a></li>
                    <li><a href="{{ route('port_task.index') }}"> <i class="icon-angle-right"></i> 任务列表 </a></li>
                </ul>
            </li>
            <li><a href="#"> <i class="icon-edit"></i> 子域名枚举 <i
                        class="arrow icon-angle-left"></i></a>
                <ul class="sub-menu">
                    <li><a href="{{ route('subdomain_task.create') }}"> <i class="icon-angle-right"></i> 新建任务 </a></li>
                    <li><a href="{{ route('subdomain_task.index') }}"> <i class="icon-angle-right"></i> 任务列表 </a></li>
                </ul>
            </li>
            <li><a href="#"> <i class="icon-search"></i> web指纹识别 <i
                        class="arrow icon-angle-left"></i></a>
                <ul class="sub-menu">
                    <li><a href="{{ route('finger_scan_task.create') }}"> <i class="icon-angle-right"></i> 新建任务 </a></li>
                    <li><a href="{{ route('finger_scan_task.index') }}"> <i class="icon-angle-right"></i> 任务列表 </a></li>
                </ul>
            </li>
            <li><a href="#"> <i class="icon-eye-open"></i> 基于POC的漏洞检测 <i
                        class="arrow icon-angle-left"></i></a>
                <ul class="sub-menu">
                    <li><a href="{{ route('poc_scan_task.create') }}"> <i class="icon-angle-right"></i> 新建任务 </a></li>
                    <li><a href="{{ route('poc_scan_task.index') }}"> <i class="icon-angle-right"></i> 任务列表 </a></li>
                    <li><a href="{{ route('poc_scan_task.vul') }}"> <i class="icon-angle-right"></i> 漏洞管理 </a></li>
                </ul>
            </li>
        </ul>
    </div>
</div>
