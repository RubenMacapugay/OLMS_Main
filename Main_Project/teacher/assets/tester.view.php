<div class="card-body section-table-content custom-hide">
                        
    <!-- Module Section resultModuleSectionFirstGrading -->
    <?php while($rowModuleTask = $resultModuleSectionFourthGrading->fetch_assoc()): ?>
        <div class="card mb-2">
            <div class="card-body">
                <h4 class="module-section-title fw-bold"><?php echo $rowModuleTask['module_section_name']; ?></h4>
                <p class="module-section-desc"><?php echo $rowModuleTask['module_section_desc']; ?></p>
                <table class="table table-hover p-0 section-table">
                    <tbody>
                        <!-- Display the Module Section tasks and modules -->
                            <thead>
                                <tr class="text-center">
                                    <th></th>
                                    <th>Actions</th>
                                    <th>Start</th>
                                    <th>Due</th>
                                    <th>Permit</th>
                                </tr>
                            </thead>

                            <!-- Display the list of modules here per Module Section -->
                            <tr class="module-module">
                                <td class="">
                                    <a class="section-link" href="student.module.php">01 Module 1</a>
                                </td>
                                <td>
                                        <i class="fa-regular fa-pen-to-square text-primary  me-2"
                                            type="button"></i>
                                        <i class="fa-solid fa-trash text-danger me-2"
                                            type="button"></i>
                                </td>
                                <td class="">-</td>
                                <td class="">-</td>
                                <td class="">
                                    <input class="btn btn-success fs-6 py-0" type="submit" value="give">
                                </td>
                            </tr>

                            <!-- Displaying Task Per Module_section_tbl -->
                            <?php while($rowGrading = $resultTasksFourthGrading->fetch_assoc()): ?>
                                <tr class="module-task">
                                    <td><a href="#"><?php echo $rowGrading['task_name'];?></a></td>
                                    <td>
                                        <i class="fa-regular fa-pen-to-square text-primary  me-2"
                                            type="button"></i>
                                        <i class="fa-solid fa-trash text-danger me-2"
                                            type="button"></i>
                                    </td>
                                    <td class="">-</td>
                                    <td class="">-</td>
                                    <td class="">
                                        <form method='POST' action='../../includes/teacher.createtask.inc.php'>
                                            <input type="hidden" type="hidden" name="taskId" value="<?php echo $rowGrading['task_list_id'];?>"> 
                                            
                                            <?php 
                                                $isGiven = $rowGrading['given'];
                                                if($isGiven == "Yes"){
                                                    echo '<input type="hidden" type="hidden" name="isGiven" value="No">';
                                                    echo '<input class="btn btn-danger fs-6 py-0" type="submit" name="updateTaskGive" value="ungive">';
                                                    
                                                } else if($isGiven == "" ||$isGiven == "No"){
                                                    echo '<input type="hidden" type="hidden" name="isGiven" value="Yes">';
                                                    echo '<input class="btn btn-success fs-6 py-0" type="submit" name="updateTaskGive" value="give">';
                                                }
                                            ?>
                                        </form>
                                    </td>
                                    
                                </tr>
                            <?php endwhile; ?>

                    </tbody>
                </table>
            </div>
        </div>
    <?php endwhile; ?>

    <div class="card mb-2">
        <div class="card-header">
            <h4 class="section-title">Module Task 2</h4>
        </div>
        <div class="card-body"></div>
    </div>

    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createModuleSection" id="btnFirstGrading">Add Section</button>
</div>